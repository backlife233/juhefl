@extends('app')

@section('content')
    <div class="bg-color-grey ptb--80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="user_sidebar user_box">
                        <ul class="text-center">
                            <li><a href="{{route('user.friends')}}">友链管理</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="user_container user_box">
                        <div class="user_content_title">
                            <h2>@yield('user_title')</h2>
                        </div>
                        <div class="user_content_body">
                            @yield('user_body')
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
