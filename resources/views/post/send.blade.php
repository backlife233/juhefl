@extends('app')

@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/simditor/simditor-2.3.28/styles/simditor.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/simditor/simditor-2.3.28/styles/customized.css')}}">

@endsection

@section('content')
    <div class="container-sm">
        <div class="row pt--30 pb--30">
            <div class="col-12">
                <form id="post_form">
                    <div class="row row--10">
                        <div class="col-12">
                            <div class="form-group">
                                <label>标题</label>
                                <input class="" id="title" type="text" name="title" required autofocus
                                       @if($isEdit)
                                       value="{{$post->title}}"
                                    @endif
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>分类</label>
                                <select id="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->getKey()}}"
                                                data-alias="{{$category->category_alias}}"
                                                @if($isEdit && $category->category_alias === $post->category_alias)
                                                selected
                                            @endif
                                        >{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>内容</label>
                                <textarea id="content">@if($isEdit){!! $post->content !!}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>解锁内容</label>
                                <textarea
                                    id="hide_content">@if($isEdit){!! $post->hide_content !!}@endif</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>解锁所需金币</label>
                                <input id="need_coin" type="number" name="need_coin"
                                       @if($isEdit)
                                       value="{{$post->need_coin}}"
                                       @else
                                       value="10"
                                    @endif
                                />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>是否可下载</label>
                                <div class="d-inline-block ml--10" id="has_download">
                                    <div class="form-check form-check-inline">
                                        <input style="height: 6px" class="form-check-input" type="radio"
                                               name="has_download" id="inlineRadio1" value="1"
                                               @if($isEdit && $post->has_download===1)
                                               checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="inlineRadio1">是</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input style="height: 6px" class="form-check-input" type="radio"
                                               name="has_download" id="inlineRadio2" value="0"
                                               @if(!$isEdit || ($isEdit && $post->has_download===0))
                                               checked
                                            @endif
                                        >
                                        <label class="form-check-label" for="inlineRadio2">否</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>悬赏金币</label>
                                <input id="reward_coin" type="number" name="reward_coin"
                                       @if($isEdit)
                                       value="{{$post->reward_coin}}"
                                       @else
                                       value="10"
                                    @endif
                                />
                            </div>
                        </div>
                        <div class="col-12 line">
                            <p style="font-size: 0.5em;margin-bottom: 5px">
                                发布GIF，解锁内容必须包含准确的关键字信息可供准确搜索或可下载，他人解锁你的资源，你将获得全部解锁金币。</p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                发布求出处{{--，将扣除50金币+你的悬赏金币，请慎重--}}。采纳回答后，悬赏金币将会给回答者。悬赏金币由本站发放给回答者，提问者不用担心。</p>
                            <p style="font-size: 0.5em;margin-bottom: 30px">
                                确保图片上传成功再发布。上传后，点击图片，看看图片链接是否是http开头，如果是data开头证明没有上传成功</p>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit cerchio">
                                <input type="button" id="post_send" class="axil-button button-rounded"
                                       value="发布">
                                <img src="/assets/images/loading.svg" style="display: none">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('assets/plugins/simditor/simditor-2.3.28/scripts/module.js')}}"></script>
    <script src="{{asset('assets/plugins/simditor/simditor-2.3.28/scripts/hotkeys.js')}}"></script>
    <script src="{{asset('assets/plugins/simditor/simditor-2.3.28/scripts/uploader.js')}}"></script>
    <script src="{{asset('assets/plugins/simditor/simditor-2.3.28/scripts/simditor.js')}}"></script>
@endsection

@section('script')
    <script>
        $(function () {
            let isEdit = '{{$isEdit}}' === '1';

            @if($isEdit)
            let url = '{{route('post.update',['post'=>$post->getKey()])}}';
            @else
            let url = '{{route('post.store')}}';
            @endif

            // if ($('#content').attr('initialized')) {
            //     return;
            // }

            var config = {
                "defaultImage": "/",
                "upload": {
                    "url": "{{route('post.upload')}}",
                    "fileKey": "upload_file",
                    "connectionCount": 3,
                    "leaveConfirm": "正在上传图片，确定离开？",
                    "params": {_token: HUB._token}
                },
                // "allowedTags":["iframe"],
                "allowedAttributes": {
                    "iframe": ['class', 'src'],
                    "p": ['class'],
                },
                "tabIndent": true,
                "toolbar": ["title", "bold", "italic", "underline", "strikethrough", "fontScale", "color", "|", "ol", "ul", "blockquote", "code", "table", "|", "link", "image", "hr", "|", "indent", "outdent", "alignment"],
                "toolbarFloat": true,
                "toolbarFloatOffset": 0,
                "toolbarHidden": false,
                "pasteImage": true,
                "cleanPaste": false
            }
            config['textarea'] = $('#content');
            let editor = new Simditor(config);

            config['textarea'] = $('#hide_content');
            let hideEditor = new Simditor(config);

            // $('#content').attr('initialized', 1);

            function loading() {
                $('#post_send').attr('disabled','true');
                $('#post_send').next('img').show()
            }

            function loaded() {
                $('#post_send').removeAttr('disabled');
                $('#post_send').next('img').hide()
            }

            $('#category_id').change(function () {
                let self = $(this)
                let val = self.find('option:selected').attr('data-alias')

                if (val === 'gif') {
                    $('#content').closest('.form-group').show()
                    $('#has_download').closest('.form-group').show()
                    $('#hide_content').closest('.form-group').show()
                    $('#need_coin').closest('.form-group').show()
                    $('#reward_coin').closest('.form-group').hide()
                }
                if (val === 'wanted') {
                    $('#content').closest('.form-group').show()
                    $('#has_download').closest('.form-group').hide()
                    $('#hide_content').closest('.form-group').hide()
                    $('#need_coin').closest('.form-group').hide()
                    $('#reward_coin').closest('.form-group').show()
                }
            })

            //发布
            $('#post_send').click(function () {
                loading();
                let params = {
                    _token: HUB._token,
                    title: $('#title').val(),
                    need_coin: $('#need_coin').val(),
                    reward_coin: $('#reward_coin').val(),
                    content: editor.getValue(),
                    hide_content: hideEditor.getValue(),
                    category_id: $('#category_id').val(),
                    has_download: $('#has_download input:checked').val()
                };

                $.ajax({
                    method: isEdit ? 'put' : 'post',
                    url: url,
                    data: params,
                    success: function (res) {
                        if (res.code === 200) {
                            window.showMessage(res.msg);
                            $('#content').val('');
                            $('#hide_content').val('');
                        } else {
                            window.showMessage(res.message);
                        }

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

            $('#category_id').trigger('change')
        })
    </script>
@endsection
