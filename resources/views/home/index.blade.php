@extends('app')

@section('content')
    @include('parts.banner')

    <!-- Start Post List Wrapper  -->
    <div class="axil-post-list-area post-listview-visible-color axil-section-gap bg-color-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-8">
                    @foreach($posts as $key=>$post)
                        <div class="content-block post-list-view is-active mt--30">
                            <div class="post-thumbnail">
                                <a href="{{$post->link}}">

                                    <img class="lazy" src="{{$post->cover_preview_url_safe}}"
                                         data-original="{{$post->cover_url_safe}}"
                                         alt="{{$post->title}}">

                                </a>
                            </div>
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
                                <h4 class="title"><a href="{{$post->link}}">{{$post->title_safe}}</a></h4>
                                <div class="post-meta-wrapper">
                                    <div class="post-meta">
                                        <div class="post-author-avatar border-rounded">
                                            <img src="{{$post->author_avatar}}"
                                                 alt="{{$post->author_name}}">
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
                                                <li>{{$post->created_at_human}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul class="social-share-transparent justify-content-end">
                                        @if($post->has_download)
                                            <li style="font-size: 0.7em"><i class="fas fa-download"></i></li>
                                        @endif
                                        <li><a href="{{$post->link}}"><i
                                                    class="fas fa-eye"></i>&nbsp;&nbsp;{{$post->view_count_format}}</a>
                                        </li>
                                    </ul>
                                    <div class="tagcloud mt--5" style="padding-left: 12%">
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
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt--20 m-auto">
                        {{$posts->links()}}
                    </div>
                </div>
                @include('parts.sidebar')
            </div>
        </div>
    </div>
    <!-- End Post List Wrapper  -->
@endsection
