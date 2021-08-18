@extends('app')

@section('content')
    <!-- Start Error Area  -->
    <div class="bg-color-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="jump-box">
                        <a href="{{$friend->link}}"
                           class="axil-button button-rounded"><span>5</span>秒后跳转到->《{{$friend->name}}》</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Error Area  -->
@endsection

@section('script')
    <script>
        $(function () {
            let timer = setInterval(function () {
                let numBox = $('.jump-box a span');
                let s = parseInt(numBox.text());
                s--;
                if (s < 0) {
                    window.clearInterval(timer);
                    $('.jump-box a')[0].click();
                    return;
                }
                numBox.text(s);
            }, 1000)
        })
    </script>
@endsection
