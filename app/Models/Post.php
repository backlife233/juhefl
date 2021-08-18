<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends BaseModel
{
    const POST_STATUS_MAP = [
        0 => '审核中',
        1 => '通过'
    ];

    protected $primaryKey = 'post_id';

    protected $casts = [
        'images' => 'array',
        'tags'   => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'post_id');
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = preg_replace('#alt=[\'\"](.*?)[\'\"]#', 'alt="' . $this->title . '"', $value);
    }

    public function setNeedCoinAttribute($value)
    {
        $this->attributes['need_coin'] = in_array($this->category_id, [1]) ? $value : 0;
    }

    public function setRewardCoinAttribute($value)
    {
        $this->attributes['reward_coin'] = in_array($this->category_id, [2]) ? $value : 0;
    }

    public function getCoverUrlSafeAttribute()
    {
        if (is_safe_mode()) {
            return asset('assets/images/hello.gif');
        }

        $time = $this->updated_at;

        return $this->cover ? Storage::url($this->cover) . (!is_null($time) ? '?' . $time->timestamp : '') : asset('assets/images/hello.gif');
    }

    public function getCoverPreviewUrlSafeAttribute()
    {
        if (is_safe_mode()) {
            return asset('assets/images/hello.jpg');
        }

        $cover = str_replace('.gif', '_preview.jpg', $this->cover);
        if (!(Storage::disk('public')->exists($cover))) {
            return $this->cover ? Storage::url($this->cover) : asset('assets/images/hello.jpg');
        }

        $time = $this->updated_at;

        return $cover ? Storage::url($cover) . (!is_null($time) ? '?' . $time->timestamp : '') : asset('assets/images/hello.gif');

    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at->diffForHumans(now());
    }

    public function getViewCountFormatAttribute()
    {
        $value = $this->view_count * ((int)$this->getKey() % 10 + 2);
        if ($value > 10000) {
            $value = number_format(($value / 10000), 1) . 'w';
        }
        return (string)$value;
    }

    public function getLikesCountFormatAttribute()
    {
        return $this->likes_count ?? 0;
    }

    public function getAnsweredAttribute()
    {
        return $this->answer_id !== 0;
    }

    public function getIsOpenAttribute()
    {
        if (auth()->check() && ($this->user_id === me()->getKey() || me()->is_vip)) {
            return true;
        }

        $isBuy = $this->unlockUsers()->where('user_id', auth()->check() ? me()->getKey() : 0)->exists();
        if ($isBuy) {
            return true;
        }

        return $this->need_coin == 0;
    }

    public function getLinkAttribute()
    {
        return route('posts.show', ['post' => $this->getKey(), 'category' => $this->category_alias ?? 'gif']);
    }

    public function getTitleSafeAttribute()
    {
        if (is_safe_mode()) {
            return Str::random(15);
        }

        return $this->title;
    }

    public function getCategoryNameAttribute()
    {
        $categories = Cache::get('categories');

        $category = $categories->where('category_id', $this->category_id)->first();

        return safe_str(is_null($category) ? 'GIF' : $category->category_name);
    }

    public function getIsLikeAttribute()
    {
        $user = auth()->user();
        if (is_null($user)) {
            return false;
        }
        return $this->likes()->where(['user_id' => $user->getKey()])->exists();
    }

    public function getAuthorNameAttribute()
    {
        $user = $this->user;

        return $user ? $user->name : 'Faker';
    }

    public function getAuthorAvatarAttribute()
    {
        $user = $this->user;

        return ($user && $user->avatar) ? Storage::disk('public')->url($user->avatar) : asset('assets/images/post-images/author/author-image-2.png');
    }

    public function getPostStatusStrAttribute()
    {
        return self::POST_STATUS_MAP[$this->post_status] ?? '未知';
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function unlockUsers()
    {
        return $this->belongsToMany(User::class, 'unlock', 'post_id', 'user_id')->withPivot('unlock_id')->withTimestamps();
    }
}
