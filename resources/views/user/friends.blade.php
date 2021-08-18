@extends('user.layout')

@section('user_title','友链管理')
@section('user_body')
    <div class="posts plr--30">
        <div class="mt--20 mb--20">
            <a class="axil-button button-rounded" href="{{route('friend.create')}}">添加新的友链</a>
        </div>
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                @foreach($friends as $key=>$friend)
                    <div class="content-block post-list-view is-active mt--30">
                        <div class="post-content">
                            <div class="post-cat">
                                <div class="post-cat-list">
                                    <a class="hover-flip-item-wrapper" href="#">
                                            <span class="hover-flip-item">
                                                <span
                                                    data-text="{{$friend->category}}">{{$friend->category}}</span>
                                            </span>
                                    </a>
                                    <a href="javascript:void(0)">{{$friend->status_str}}</a>
                                    <a class="axil-button button-rounded"
                                       style="height: 26px;color: #fff;"
                                       href="{{route('friend.edit',['friend'=>$friend->getKey()])}}">修改</a>
                                    @if($friend->status!==1)
                                        <a class="axil-button button-rounded re-check-friend"
                                           style="height: 26px;color: #fff;" href="javascript:void(0)"
                                           data-key="{{$friend->getKey()}}">开始检测</a>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="title"><a href="{{$friend->link}}">{{$friend->name}}
                                            &nbsp;&nbsp;{{$friend->link}}</a></h4>
                                </div>
                                <div class="col-6 text-right">
                                    <span>当日来源：0</span>
                                    <span>总来源：0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt--20 m-auto">
                    {{$friends->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
