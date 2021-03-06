<?php

namespace App\Http\Controllers;

use App\Jobs\WaterMark;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function s()
    {
        dispatch_now(new WaterMark(storage_path('2.gif'), storage_path('news3.gif')));
    }

    public function notice()
    {
        return view('post.notice');
    }

    public function index($category = null)
    {
        $tag = request('tag');
        $got = request('got');

        $query = Post::query();
        if (!is_null($tag)) {
            $query = $query->whereJsonContains('tags', $tag);
        } else {
            $query = $query->where('category_alias', $category);
            if ($category === 'wanted') {
                if ($got === '1') {
                    $query = $query->where('answer_id', '>', 0);
                } elseif ($got === '0') {
                    $query = $query->where('answer_id', 0);
                }
            }
        }

        $posts = $query->where('post_status', 1)->orderByDesc('hot')->orderByDesc('post_id')->paginate(9);

        return view('post.index', compact('posts'));
    }

    public function show($category = null, Post $post)
    {
        if ($post->getKey() === 220) {
            return redirect(route('posts.show', ['category' => 'gif', 'post' => 221]));
        }

        $post->load(['comments' => function ($query) {
            $query->with(['subComments' => function ($query) {
                $query->where('comment_status', 1);
            }])->where('tid', 0)->where('comment_status', 1)->orderByDesc('is_answer')->orderByDesc('like');
        }, 'user'])->loadCount(['comments']);

        $robotComments = Cache::remember('robot_comment_' . $post->getKey(), 60 * 60, function () use ($post) {
            return self::robotComments($post->getKey(), $post->created_at);
        });
        $comments      = $robotComments->merge($post->comments)->sortByDesc('is_answer')->sortByDesc('like')->sortByDesc('created_at');

        $title = $post->title;

        $post->increment('view_count');

        $random = Cache::remember('recommend_posts_' . $post->getKey(), 60, function () {
            return Post::where('post_status', 1)->inRandomOrder()->take(6)->get();
        });

        return view('post.show', compact('post', 'title', 'random', 'comments'));
    }

    public function create()
    {
        $isEdit = 0;

        $categories = Category::where('user_select', 1)->get();

        return view('post.send', compact('isEdit', 'categories'));
    }

    public function edit(Post $post)
    {
        $isEdit = 1;

        $categories = Category::where('user_select', 1)->get();

        return view('post.send', compact('isEdit', 'categories', 'post'));
    }

    protected function dataValidate()
    {
        return request()->validate([
            'title'        => ['required', 'string', 'max:100'],
            'content'      => ['required', 'string'],
            'category_id'  => ['required', 'integer', 'exists:categories'],
            'hide_content' => ['required_if:category_id,1', 'nullable', 'string'],
            'need_coin'    => ['required_if:category_id,2', 'integer', function ($col, $value, $fail) {
                if (in_array(request()->category_id, ['1']) && (int)$value < 10) {
                    $fail('?????????????????????10');
                }
            }],
            'reward_coin'  => ['required_if:category_id,2', 'integer', function ($col, $value, $fail) {
                if (in_array(request()->category_id, ['2']) && (int)$value < 0) {
                    $fail('?????????????????????0');
                }
                if (in_array(request()->category_id, ['2']) && (int)$value > 1000) {
                    $fail('?????????????????????1000');
                }
            }],
            'has_download' => ['filled', 'integer', 'in:0,1']
        ], [
            'content.required'         => '???????????????',
            'hide_content.required_if' => '?????????????????????',
            'need_coin.required_if'    => '?????????????????????',
            'reward_coin.required_if'  => '?????????????????????',
        ]);
    }

    public function store()
    {
        $data = $this->dataValidate();

        $data['user_id'] = me()->getKey();

        if ($data['category_id'] == '2') {
            if (!me()->hasEnoughCoin(0)) {
                return $this->error('?????????????????????0?????????');
            }
        }

        Post::create($data);

        return $this->success('????????????', ['url' => route('user.posts')]);
    }

    public function update(Post $post)
    {
        $data = $this->dataValidate();

        $data['user_id'] = me()->getKey();

        $post->update($data);

        return $this->success('????????????', ['url' => route('user.posts')]);
    }

    public function upload(UploadService $service)
    {
        $size = request()->file('upload_file')->getSize() / 1024 / 1024;
        if ($size > 5) {
            return response()->json(['success' => false, 'msg' => '??????????????????5MB']);
        }

        $urls = $service->upload(request()->file());

        return response()->json(['success' => true, 'msg' => '??????', 'file_path' => $urls]);
    }

    public static function robotComments($postId, $start)
    {
        $now  = now();
        $diff = $now->diffInDays($start) + 1;
        $num  = random_int(5 * $diff, 10 * $diff);

        $diffSeconds = $now->diffInSeconds($start);

        $me     = auth()->user();
        $myName = is_null($me) ? null : $me->name;

        $usernames = User::select('name')->inRandomOrder()->take($num * 2)->get();
        $count     = $usernames->count();

        if ($num > $count) {
            $num = (int)($count * random_int(30, 70) / 100);
        }

        $comments = [];
        for ($i = 1; $i <= $num; $i++) {
            $user     = $usernames->pop();
            $username = $user ? $user->name : '???????????????';
            $username = $username == $myName ? '???????????????' : $username;

            $avatar = $user ? $user->avatar : asset('assets/images/hello.jpg');
            $avatar = ($username == $myName || is_null($avatar)) ? asset('assets/images/hello.jpg') : $avatar;

            $comment    = [
                'post_id'        => $postId,
                'comment'        => Comment::$guideComments[random_int(0, count(Comment::$guideComments) - 1)],
                'username'       => $username,
                'avatar'         => $avatar,
                'comment_status' => 1,
                'is_answer'      => 0,
                'like'           => 0,
                'created_at'     => $now->copy()->addSeconds(-max($diffSeconds, random_item([-1, 1]) * random_int(1, 60 * 60 * 24 * 7)))
            ];
            $comments[] = Comment::make($comment);
        }

        return collect($comments)->sortBy('created_at');
    }
}
