@extends('app')

@section('content')
    <!-- Start Banner Area -->
    <div class="slider-area bg-color-grey ptb--80">
        <div class="axil-slide slider-style-2 plr--135 plr_lg--30 plr_md--30 plr_sm--30">
            <div class="row row--10">
                <div class="col-lg-12 col-xl-12 col-md-12 col-12 mt_lg--20 mt_md--20 mt_sm--20">
                    <div class="m-auto mt--10 mb--50 text-center col-3">
                        <a id="send_post" class="axil-button button-rounded" style="width:100%"
                           href="{{route('post.create')}}">我要求出处</a>
                    </div>
                    <div class="box-wrapper box-wrapper-3">
                        @foreach($posts as $post)
                            <div class="box">
                                <!-- Start Post Grid  -->
                                <div class="content-block post-default image-rounded mb--50">
                                    <div class="post-thumbnail">
                                        <a href="{{$post->link}}">
                                            <img class="lazy" src="{{$post->cover_preview_url_safe}}"
                                                 data-original="{{$post->cover_url_safe}}"
                                                 alt="{{$post->title_safe}}">
                                        </a>
                                    </div>
                                    <div class="post-grid-content">
                                        <div class="post-content">
                                            <div class="post-cat">
                                                <div class="post-cat-list">
                                                    <a class="hover-flip-item-wrapper"
                                                       href="{{route('posts.category.index',['category'=>$post->category_alias])}}">
                                                                    <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="{{$post->category_name}}">{{$post->category_name}}</span>
                                                                    </span>
                                                    </a>
                                                    @if($post->category_alias === 'wanted')
                                                        <a class="hover-flip-item-wrapper"
                                                           href="javascript:void(0);">
                                                                    <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="悬赏{{$post->reward_coin}}">悬赏{{$post->reward_coin}}</span>
                                                                    </span>
                                                        </a>
                                                        <a class="hover-flip-item-wrapper"
                                                           href="javascript:void(0);">
                                                            @php
                                                                $str = $post->answer_id ===0 ? '未上车':'已上车';
                                                            @endphp
                                                            <span class="hover-flip-item">
                                                                        <span
                                                                            data-text="{{$str}}">{{$str}}</span>
                                                                    </span>
                                                        </a>
                                                    @endif
                                                    @if($post->has_download)
                                                        <i class="fas fa-download" style="font-size: 0.2em;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <h5 class="title"><a href="{{$post->link}}">{{$post->title_safe}}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start Post Grid  -->
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="mt--20 m-auto">
                            {{$posts->links()}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Banner Area -->
@endsection
