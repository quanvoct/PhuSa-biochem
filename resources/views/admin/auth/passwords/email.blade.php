@extends('layouts.auth')



@section('content')

<div class="col-12 col-lg-5">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ url ('/')}}"><img class="" src="{{asset('admin/images/logo.svg')}}" alt="Logo"></a>
        </div>

        <h1 class="auth-title">Quên mật khẩu</h1>
        <p class="auth-subtitle mb-5">Nhập email của bạn</p>

        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group position-relative has-icon-left mb-4">
                <input id="email" type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Gửi</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            @if (Route::has('login'))
            <p class='text-gray-600'>Bạn đã có tài khoản? <a href="{{ route('login') }}" class="font-bold">Đăng
                    nhập</a>.</p>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
</div>
@endsection