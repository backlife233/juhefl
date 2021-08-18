@extends('user.layout')

@section('user_title','卡密升级')
@section('user_body')
    <div class="plr--30">
        <div class="row">
            <div class="col-lg-12 col-xl-12">
                <form id="card_form" action="{{route('user.card.use')}}" method="post">
                    @csrf
                    <div class="row row--10">
                        <div class="col-12">
                            <div class="form-group">
                                <label>卡号</label>
                                <input id="num" type="text" name="num"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>卡密</label>
                                <input id="pwd" type="text" name="pwd"/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit cerchio">
                                <input type="submit" class="axil-button button-rounded"
                                       value="提交">
                                <img src="/assets/images/loading.svg" style="display: none">
                            </div>
                            <a href="{{route('vip')}}" class="axil-button button-rounded">购卡</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {

        })
    </script>
@endsection
