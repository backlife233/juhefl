@extends('app')

@section('content')
    <!-- Start Error Area  -->
    <div class="bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mt--30 mb--30">
                    <ul class="axil-tab-button nav nav-tabs mt--20 mb--20" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="javascript:void(0);" role="tab"
                               aria-controls="grid-one" aria-selected="true">全部</a>
                        </li>
                        @foreach($categories as $index=>$category)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="javascript:void(0);" role="tab"
                                   aria-controls="grid-one" aria-selected="true">{{$category}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <hr style="background: #2f2e2e"/>
                    <!-- Start Tab Content  -->
                    <div class="grid-tab-content tab-content" style="margin: -10px">
                        @foreach($friends as $key=>$friend)
                            <a class="friend-item" href="{{route('friend.jump',['friend'=>$friend->getKey()])}}"
                               data-category="{{$friend->category}}">{{--<img class="lazy"
                                                                          src="https://www.xpl654.xyz/favicon.ico"/>--}}{{$friend->name}}
                            </a>
                        @endforeach
                    </div>
                    <!-- End Tab Content  -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Error Area  -->
@endsection

@section('script')
    <script>
        $(function () {
            $('.nav-item').click(function () {
                let category = $(this).find('.nav-link').text();

                if (category === '全部') {
                    $('.friend-item').show();
                    return;
                }

                $('.friend-item').hide();
                $('.friend-item[data-category="' + category + '"]').show();
            })
        })
    </script>
@endsection
