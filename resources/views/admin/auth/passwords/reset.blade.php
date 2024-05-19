@extends('layouts.auth')
@section('content')
<div class="col-12 col-lg-5">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ url ('/')}}"><img class="" src="{{asset('admin/images/logo.svg')}}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Đổi mật khẩu</h1>
        <p class="auth-subtitle mb-5">Chọn mật khẩu bảo mật cho tài khoản</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group position-relative has-icon-left mb-4">
                <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                <input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group position-relative has-icon-left mb-4">
                <input id="password-confirm" type="password" class="form-control form-control-xl" name="password_confirmation" required autocomplete="new-password">
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
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đổi mật khẩu</button>
        </form>
    </div>
</div>
<div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
</div>
@endsection