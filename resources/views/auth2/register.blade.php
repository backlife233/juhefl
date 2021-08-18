@extends('app')

@section('content')
    <div class="container-sm">
        <div class="row pt--30 pb--30">
            <div class="col-xl-4 col-12 m-auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row row--10">
                        <div class="col-12">
                            <div class="form-group">
                                <label>昵称</label>
                                <input class="@error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>邮箱</label>
                                <input class="@error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>密码</label>
                                <input class="@error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>确认密码</label>
                                <input class="@error('password') is-invalid @enderror" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit cerchio">
                                <input name="submit" type="submit" id="submit" class="axil-button button-rounded" value="注册">
                            </div>
                            <a href="{{ route('login') }}" class="axil-button button-rounded ml--10" >登录</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
