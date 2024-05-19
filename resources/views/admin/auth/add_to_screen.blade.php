@extends('layouts.auth')
@section('title') Thiết lập ứng dụng @endsection

@section('content')
<div class="col-12 col-lg-5">
    <div id="auth-left">
        <div class="auth-logo">
            <a href="{{ url ('/')}}"><img class="" src="{{asset('admin/images/logo.svg')}}" alt="Logo"></a>
        </div>
        <h1 class="auth-title">Khởi động</h1>
        <p class="auth-subtitle mb-5">Thêm vào màn hình chính để truy cập nhanh hơn</p>
        <br/>
        <button type="button" class="btn btn-primary btn-lg" onclick="addToHomeScreen()">Thêm vào màn hình chính</button>

<script>
function addToHomeScreen() {
    if (window.navigator && window.navigator.standalone) {
        swal(
            `Ứng dụng MediLabor đã được cài đặt vào màn hình chính!`,
            'Cài đặt MediLabor',
            'success'
        );
    } else if (window.matchMedia('(display-mode: standalone)').matches) {
        swal(
            `Ứng dụng MediLabor đã được cài đặt vào màn hình chính!`,
            'Cài đặt MediLabor',
            'success'
        );
    } else {
        swal(
            `Vui lòng nhấn vào biểu tượng chia sẻ <i class="bi bi-box-arrow-up"></i> và chọn 'Thêm vào màn hình chính' để tiếp tục!`,
            'Cài đặt MediLabor',
            'success'
        );
    }
}
</script>

    </div>
</div>
<div class="col-12 col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
</div>
@endsection