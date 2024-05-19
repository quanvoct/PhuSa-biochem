@extends('layouts.auth')
@section('title')

Đăng kí

@endsection

@section('content')
<div class="col-12 col-lg-5">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ url ('/')}}"><img src="{{asset('admin/images/logo.svg')}}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Đăng kí</h1>
        <p class="auth-subtitle mb-5">Tạo tài khoản mới của bạn</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="name" type="text" class="form-control form-control-xl @error('name') is-invalid @enderror" name="name" placeholder="Họ và tên"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Địa chỉ email" required autocomplete="email">
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group position-relative has-icon-left mb-4">
                <input id="phone" inputmode  type="text" class="form-control form-control-xl @error('phone') is-invalid @enderror" placeholder="Số điện thoại"
                name="phone" value="{{ old('phone') }}" required autocomplete="phone" inputmode="numeric" >
                <div class="form-control-icon">
                     <i class="bi bi-telephone"></i>
                </div>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group position-relative has-icon-left mb-4">
                <input id="address" type="text" class="form-control form-control-xl @error('address') is-invalid @enderror" placeholder="Địa chỉ"
                name="address" value="{{ old('address') }}" required autocomplete="address">
                <div class="form-control-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group position-relative has-icon-left mb-4">
                <input input id="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" name="password" required placeholder="Tạo mật khẩu" autocomplete="new-password">
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
                <input id="password-confirm" type="password" class="form-control form-control-xl" name="password_confirmation" required placeholder="Xác nhận mật khẩu" autocomplete="new-password">
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đăng kí</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            @if (Route::has('login'))
            <p class='text-gray-600'>Bạn đã có tài khoản? <a href="{{ route('login') }}" class="font-bold">Đăng nhập</a>.</p>
            @endif
        </div>
    </div>
</div>
<div class="col-12 col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
</div>
@endsection