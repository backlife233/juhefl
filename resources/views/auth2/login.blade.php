@extends('app')

@section('content')
    <div class="container-sm">
        <div class="row pt--30 pb--30">
            <div class="col-xl-4 col-12 m-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row row--10">
                        <div class="col-12">
                            <div class="form-group">
                                <label>邮箱</label>
                                <input class="@error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input class="@error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-submit cerchio">
                                <input name="submit" type="submit" id="submit" class="axil-button button-rounded" value="登录">
                            </div>
                            <a href="{{ route('register') }}" class="axil-button button-rounded ml--10" >注册</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
