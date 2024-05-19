@extends('layouts.auth')
@section('title')

Đăng nhập

@endsection

@section('content')
<div class="col-12 col-lg-5">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ url ('/')}}"><img class="" src="{{asset('admin/images/logo.svg')}}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Đăng nhập</h1>
        <p class="auth-subtitle mb-5">Đăng nhập với tài khoản của bạn</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Địa chỉ email" autocomplete="email" autofocus>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
                <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label text-gray-600" for="remember">
                    Giữ đăng nhập
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đăng nhập</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            @if (Route::has('register'))
            <p class="text-gray-600">Bạn chưa có tài khoản <a href="{{ url('register')}}" class="font-bold">Đăng kí</a></p>
            @endif
            @if (Route::has('password.request'))
            <p><a class="font-bold" href="{{ route('password.request') }}">Tôi quên mật khẩu</a>.</p>
            @endif
        </div>
    </div>
</div>
<div class="col-12 col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
</div>
@endsection