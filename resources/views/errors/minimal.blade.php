@extends('app')

@section('content')
    <!-- Start Error Area  -->
    <div class="error-area bg_image--4 bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner">
                        <h1 style="font-size: 7em">@yield('code')</h1>
                        <h2 class="title" style="font-size: 3em">@yield('message')</h2>
                        @if(isset($right))
                            <p>Something all right.</p>
                        @else
                            <p>Sorry,something wrong.</p>
                        @endif
                        <div class="back-totop-button cerchio d-inline-block">
                            <a class="axil-button button-rounded hover-flip-item-wrapper" href="{{route('index')}}">
                                    <span class="hover-flip-item">
                                        <span data-text="返回首页">返回首页</span>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Error Area  -->
@endsection
