@extends('app')

@section('content')
    <!-- Start Post Single Wrapper  -->
    <div class="post-single-wrapper axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Start Banner Area -->
                    <div class="banner banner-single-post post-formate post-video axil-section-gapBottom">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Start Single Slide  -->
                                    <div class="content-block">
                                        <!-- Start Post Content  -->
                                        <div class="post-content">
                                            <div class="post-cat">
                                                <div class="post-cat-list">
                                                    <a class="hover-flip-item-wrapper" href="#">
                                                            <span class="hover-flip-item">
                                                                <span
                                                                    data-text="{{$post->category_name}}">{{$post->category_name}}</span>
                                                            </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <h1 class="title">{{$post->title_safe}}</h1>
                                            <!-- Post Meta  -->
                                            <div class="post-meta-wrapper">
                                                <div class="post-meta">
                                                    <div class="post-author-avatar border-rounded">
                                                        <img
                                                            src="{{$post->author_avatar}}"
                                                            alt="Author Images">
                                                    </div>
                                                    <div class="content">
                                                        <h6 class="post-author-name">
                                                            <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="{{$post->author_name}}">{{$post->author_name}}</span>
                                                                    </span>
                                                            </a>
                                                        </h6>
                                                        <ul class="post-meta-list">
                                                            <li>Lv.1</li>
                                                            <li>新手</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="social-share-transparent justify-content-end">
                                                    @if($post->category_alias === 'wanted' && $post->reward_coin !== 0)
                                                        <li style="font-size: 1.2em;line-height: 1.2em;color: var(--color-primary);">
                                                            悬赏<i
                                                                class="fas fa-coins mr--5 ml--5"></i>{{$post->reward_coin}}
                                                        </li>
                                                    @endif
                                                    @if($post->has_download)
                                                        <li><i class="fas fa-download"></i></li>
                                                    @endif
                                                    <li><i class="fas fa-eye"></i>&nbsp;{{$post->view_count_format}}
                                                    </li>
                                                    <li><i class="fas fa-clock"></i>&nbsp;{{$post->created_at_human}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End Post Content  -->
                                    </div>
                                    <!-- End Single Slide  -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Banner Area -->

                    <div class="axil-post-details" id="post_content">
                        {!! $post->content !!}

                        @if($post->category_id === 1)
                            @if($post->is_open)
                                <hr style="border-top:1px dashed"/>
                                {!! $post->hide_content !!}
                            @else
                                <div class="row">
                                    <div class="col-12 hide_content">
                                        @auth
                                            @if(me()->invite_time > 0)
                                                <input type="button" id="unlock" data-model_id="{{$post->getKey()}}"
                                                       class="axil-button button-rounded"
                                                       value="邀请次数解锁，剩余{{me()->invite_time}}次">
                                            @else
                                                <a id="invite_friend" class="axil-button button-rounded"
                                                   href="{{route('user.setting')}}">邀请好友获取解锁次数</a>
                                            @endif
{{--                                            <p><small>解锁内容一定包含可搜索到的相关信息的关键字，标题有下载图标表示有下载链接或资源。</small></p>--}}
{{--                                            <a href="{{route('posts.notice')}}" class="axil-button button-rounded">获取赞助VIP，解锁所有资源</a>--}}
                                                <a href="{{route('vip',['type'=>'alipay'])}}" class="axil-button button-rounded">支付宝点击购买->成为赞助VIP<-</a>
                                                <a href="{{route('vip',['type'=>'wxpay'])}}" class="axil-button button-rounded">微信点击购买->成为赞助VIP<-</a>
                                        @else
                                            <a href="{{route('login')}}"
                                               class="axil-button button-rounded">登录</a>
                                            <p><small>登录查看</small></p>
                                        @endauth
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="tagcloud">
                            @if(!is_null($post->tags))
                                @foreach($post->tags as $tag)
                                    @if($tag === 'Banner')
                                        @continue
                                    @endif
                                    <a href="{{route('posts.category.index',['category'=>'gif','tag'=>$tag])}}"
                                       class="active">{{$tag}}</a>
                                @endforeach
                            @endif
                        </div>

                        <div class="social-share-block">
                            <div class="post-like">
                                <a href="javascript:void(0);" id="post_like" data-model_id="{{$post->getKey()}}" class="
@if($post->is_like)
                                    active
@endif"><i
                                        class="fal fa-thumbs-up"></i><span
                                        class="num">{{$post->likes_count_format}}</span><span>&nbsp;赞</span></a>
                            </div>
                            <ul class="social-icon icon-rounded-transparent md-size">
                                <li><a href="{{config('telegram')}}"><i class="fab fa-telegram-plane"></i></a></li>
                            </ul>
                        </div>

                        <!-- Random -->
                        <div class="row row--10 mt--20 recommend_posts">
                            <h4>推荐</h4>
                            <div class="col-lg-12 col-xl-12 col-md-12 col-12 mt_lg--20 mt_md--20 mt_sm--20">
                                <div class="box-wrapper box-wrapper-3">
                                    @foreach($random as $r)
                                        <div class="box">
                                            <!-- Start Post Grid  -->
                                            <div class="content-block post-default image-rounded mt--30">
                                                <div class="post-thumbnail">
                                                    <a href="{{$r->link}}">
                                                        <img class="lazy" src="{{$r->cover_preview_url_safe}}"
                                                             data-original="{{$r->cover_url_safe}}"
                                                             alt="{{$r->title_safe}}">
                                                    </a>
                                                </div>
                                                <div class="post-grid-content">
                                                    <div class="post-content">
                                                        <div class="post-cat">
                                                            <div class="post-cat-list">
                                                                <a class="hover-flip-item-wrapper" href="#">
                                                                    <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="{{$r->category_name}}">{{$r->category_name}}</span>
                                                                    </span>
                                                                </a>
                                                                @if($r->has_download)
                                                                    <i class="fas fa-download"></i>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <h5 class="title"><a href="{{$r->link}}">{{$r->title_safe}}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Start Post Grid  -->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Start Comment Form Area  -->
                        <div class="axil-comment-area">
                            <!-- Start Comment Respond  -->
                            <div class="comment-respond">
                                <form action="#">
                                    <div class="row row--10">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>评论，请勿发布无意义、灌水评论（下面快速评论可以复制粘贴）！第一次扣除50%已有金币，第二次封IP。</label>
                                                <textarea name="message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-submit cerchio">
                                                <input name="submit" type="button" id="send_comment"
                                                       class="axil-button button-rounded" value="发送"
                                                       data-model_id="{{$post->getKey()}}" data-pid="0">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Comment Respond  -->

                            <!-- Start Comment Area  -->
                            <div class="axil-comment-area">
                                <h4 class="title">{{$comments->count()}}&nbsp;&nbsp;条评论</h4>
                                <ul class="comment-list">
                                @foreach($comments as $comment)
                                    <!-- Start Single Comment  -->
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="single-comment">
                                                    <div class="comment-img">
                                                        <img
                                                            src="{{$comment->avatar_url}}"
                                                            alt="{{$comment->username}}">
                                                    </div>
                                                    <div class="comment-inner">
                                                        <h6 class="commenter">
                                                            <a class="hover-flip-item-wrapper" href="#">
                                                                <span class="hover-flip-item">
                                                                    <span
                                                                        data-text="{{$comment->username}}">{{$comment->username}}</span>
                                                                </span>
                                                            </a>
                                                        </h6>
                                                        <div class="comment-meta">
                                                            <div class="time-spent">{{$comment->created_at_human}}</div>
                                                            <div class="reply-edit">
                                                                <div class="reply">
                                                                    <a class="comment-reply-link hover-flip-item-wrapper"
                                                                       href="javascript:void(0);">
                                                                        <span class="hover-flip-item">
                                                                            <span class="reply_button" data-text="回复"
                                                                                  data-cid="{{$comment->getKey()}}"
                                                                                  data-pid="{{$comment->pid}}"
                                                                                  data-username="{{$comment->username}}">回复</span>
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="like-edit">
                                                                <div class="comment_like">
                                                                    <a href="javascript:void(0);"
                                                                       data-model_id="{{$comment->getKey()}}" class="
                                                                    comment_like_button
@if(false)
                                                                        active
@endif"><i
                                                                            class="fal fa-thumbs-up"></i><span
                                                                            class="num">{{$comment->like}}</span></a>
                                                                </div>
                                                            </div>
                                                            <div class="adopt-edit
@if($comment->is_answer)
                                                                active
@endif
                                                                ">
                                                                <div class="comment_adopt">
                                                                    <a href="javascript:void(0);"
                                                                       data-model_id="{{$comment->getKey()}}"
                                                                       class="adopt_button">
                                                                        <i class="fas fa-map-marker-check"></i><span>@if($comment->is_answer)
                                                                                已@endif采纳</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="comment-text">
                                                            <p class="b2">{{$comment->comment}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="children">
                                                <!-- Start Single Comment  -->
                                                @foreach($comment->subComments as $subComment)
                                                    <li class="comment">
                                                        <div class="comment-body">
                                                            <div class="single-comment">
                                                                <div class="comment-img">
                                                                    <img
                                                                        src="{{$subComment->avatar_url}}"
                                                                        alt="{{$subComment->username}}">
                                                                </div>
                                                                <div class="comment-inner">
                                                                    <h6 class="commenter">
                                                                        <a class="hover-flip-item-wrapper"
                                                                           href="javascript:void(0);">
                                                                <span class="hover-flip-item">
                                                                    <span
                                                                        data-text="{{$subComment->username}}">{{$subComment->username}}</span>
                                                                </span>
                                                                        </a>
                                                                    </h6>
                                                                    <div class="comment-meta">
                                                                        <div
                                                                            class="time-spent">{{$subComment->created_at_human}}</div>
                                                                        <div class="reply-edit">
                                                                            <div class="reply">
                                                                                <a class="comment-reply-link hover-flip-item-wrapper"
                                                                                   href="javascript:void(0);">
                                                                        <span class="hover-flip-item">
                                                                            <span class="reply_button" data-text="回复"
                                                                                  data-cid="{{$subComment->getKey()}}"
                                                                                  data-pid="{{$subComment->pid}}"
                                                                                  data-username="{{$subComment->username}}">回复</span>
                                                                        </span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comment_like">
                                                                            <a href="javascript:void(0);"
                                                                               data-model_id="{{$subComment->getKey()}}"
                                                                               class="
                                                                            comment_like_button
@if(false)
                                                                                   active
@endif"><i
                                                                                    class="fal fa-thumbs-up"></i><span
                                                                                    class="num">{{$subComment->like}}</span></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-text">
                                                                        <p class="b2">{{$subComment->comment}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                            @endforeach
                                            <!-- End Single Comment  -->
                                            </ul>
                                        </li>
                                        <!-- End Single Comment  -->
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End Comment Area  -->
                        </div>
                        <!-- End Comment Form Area  -->
                    </div>
                </div>

                @include('parts.sidebar')
            </div>
        </div>
    </div>
    <!-- End Post Single Wrapper  -->
@endsection

@section('script')
    <script>
        $(function () {
            let update = '{{$post->updated_at->timestamp}}'

            $('#post_content a').attr({rel: "noreferrer", referrerPolicy: "no-referrer"});
            $('#post_content img').not('.recommend_posts img').not('.axil-comment-area img').each(function (k, item) {
                let src = $(item).attr('src');
                src = src + '?' + update;
                $(item).attr({src: src})
            })
        })
    </script>
@endsection
