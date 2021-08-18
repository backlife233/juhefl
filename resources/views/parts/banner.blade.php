<!-- Start Banner Area -->
<div class="slider-area bg-color-grey ptb--80">
    <div class="axil-slide slider-style-2 plr--135 plr_lg--30 plr_md--30 plr_sm--30">
        <div class="row row--10">
            <div class="col-lg-12 col-xl-6 col-md-12 col-12">
            @foreach($banners->splice(0,1) as $post)
                <!-- Start Post Grid  -->
                    <div class="content-block post-grid post-grid-transparent post-overlay-bottom">
                        <div class="post-thumbnail first">
                            <a href="{{$post->link}}">

                                    <img class="lazy" src="{{$post->cover_preview_url_safe}}"
                                         data-original="{{$post->cover_url_safe}}"
                                         alt="{{$post->title}}">

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
                                    </div>
                                </div>
                                <h3 class="title"><a href="{{$post->link}}"
                                                     title="{{$post->title}}">{{$post->title}}</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- Start Post Grid  -->
                @endforeach
            </div>
            <div class="col-lg-12 col-xl-6 col-md-12 col-12 mt_lg--20 mt_md--20 mt_sm--20">
                <div class="row row--10">
                    @foreach($banners as $post)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb--20">
                            <!-- Start Post Grid  -->
                            <div
                                class="content-block post-grid post-grid-transparent post-grid-small post-overlay-bottom">
                                <div class="post-thumbnail">
                                    <a href="{{$post->link}}">
                                        <img class="lazy" src="{{$post->cover_preview_url_safe}}"
                                             data-original="{{$post->cover_url_safe}}"
                                             alt="{{$post->title}}">
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
                                            </div>
                                        </div>
                                        <h5 class="title"><a href="{{$post->link}}"
                                                             title="{{$post->title}}">{{$post->title}}</a></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Post Grid  -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Area -->
