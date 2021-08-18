@extends('app')

@section('content')
    <div class="container-sm">
        <div class="row pt--30 pb--30">
            <div class="col-12">
                <form id="friend_form">
                    <div class="row row--10">
                        <div class="col-12">
                            <div class="form-group">
                                <label>网站名称</label>
                                <input class="" id="name" type="text" name="name" required autofocus
                                       @if($isEdit)
                                       value="{{$friend->name}}"
                                    @endif
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>网站链接</label>
                                <input class="" id="link" type="text" name="link" placeholder="http://或者https://开头"
                                       required autofocus
                                       @if($isEdit)
                                       value="{{$friend->link}}"
                                    @endif
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>分类</label>
                                <select id="category">
                                    @foreach($categories as $category)
                                        <option value="{{$category}}"
                                                data-alias="{{$category}}"
                                                @if($isEdit && $category === $friend->category)
                                                selected
                                            @endif
                                        >{{$category}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 line">
                            <p style="font-size: 0.5em;margin-bottom: 5px">
                                添加友链前，请确保贵站已经将本站链接加上
                                <xmp style="font-size: 0.5em">
                                    <a href="{{config('app.url')}}" target="_blank">{{config('website_name')}}</a>
                                </xmp>
                            </p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                提交之后会立即验证是否已上本站友链
                            </p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                本站不要求友链位置，但会根据来源量在本站首页排名，贵站点击到本站量越大，那么贵站排名越靠前。
                            </p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                每天本站会自动检测贵站是否保持友链展示，请确保贵站可以正常访问，如有特殊情况无法访问，请联系客服。
                            </p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                每天本站会自动清除一天内来源为0的站点，这类站点需要<a href="{{route('user.friends')}}">友链管理</a>中重新检测后，重新激活
                            </p>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit cerchio">
                                <input type="button" id="friend_send" class="axil-button button-rounded"
                                       value="提交">
                                <img src="/assets/images/loading.svg" style="display: none">
                            </div>
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
            let isEdit = '{{$isEdit}}' === '1';

            @if($isEdit)
            let url = '{{route('friend.update',['friend'=>$friend->getKey()])}}';
            @else
            let url = '{{route('friend.store')}}';
            @endif

            function loading() {
                $('#friend_send').attr('disabled', 'true');
                $('#friend_send').next('img').show()
            }

            function loaded() {
                $('#friend_send').removeAttr('disabled');
                $('#friend_send').next('img').hide()
            }

            //发布
            $('#friend_send').click(function () {
                //loading();
                let params = {
                    _token: HUB._token,
                    name: $('#name').val(),
                    link: $('#link').val(),
                    category: $('#category').val(),
                };

                $.ajax({
                    method: isEdit ? 'put' : 'post',
                    url: url,
                    data: params,
                    success: function (res) {
                        window.showMessage(res.msg);

                        loaded();

                        if (res.data.url) {
                            let redirect = function () {
                                window.location.href = res.data.url;
                            };
                            setTimeout(redirect, 1000)
                        }
                    },
                    error: window.ajaxError
                })
            })
        })
    </script>
@endsection
