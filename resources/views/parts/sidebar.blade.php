<div class="col-lg-4 col-xl-4 mt_md--40 mt_sm--40">
    <!-- Start Sidebar Area  -->
    <div class="sidebar-inner">
        <div class="axil-single-widget widget mb--30">
            <div style="width:100%" class="mt--30 text-center">
                <a id="invite_friend" class="axil-button button-rounded" style="width:100%" href="{{route('user.setting')}}">邀请好友解锁资源</a>
            </div>
            <div style="width:100%" class="mt--30 text-center">
                <a id="send_post" class="axil-button button-rounded" style="width:100%" href="{{route('post.create')}}">发布</a>
            </div>
        </div>

        <!-- Start Single Widget  -->
        <div class="axil-single-widget widget widget_search mb--30">
            <h5 class="widget-title">Search</h5>
            <form action="#">
                <div class="axil-search form-group">
                    <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
        </div>
        <!-- End Single Widget  -->

        <!-- Start Single Widget  -->
        <div class="axil-single-widget widget widget_postlist mb--30">
            <h5 class="widget-title">热门</h5>
            <!-- Start Post List  -->
            <div class="post-medium-block">
            @foreach($hot_posts as $post)
                <!-- Start Single Post  -->
                    <div class="content-block post-medium mb--20">
                        <div class="post-thumbnail">
                            <a href="{{$post->link}}">
                                <img class="lazy_side" src="{{$post->cover_preview_url_safe}}"
                                     data-original="{{$post->cover_url_safe}}"
                                     alt="{{$post->title}}">
                            </a>
                        </div>
                        <div class="post-content">
                            <h6 class="title"><a href="{{$post->link}}">{{$post->title}}</a></h6>
                            <div class="post-meta">
                                <ul class="post-meta-list">
                                    <li>{{$post->created_at_human}}</li>
                                    <li><i class="fas fa-eye"></i>&nbsp;&nbsp;{{$post->view_count_format}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Post  -->
                @endforeach
            </div>
            <!-- End Post List  -->
        </div>
        <!-- End Single Widget  -->
    </div>
    <!-- End Sidebar Area  -->
</div>
