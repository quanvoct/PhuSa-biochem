<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Thẻ favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/images/logo.png') }}" type="image/x-icon">
    <!-- Định nghĩa web app -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Tên và màu nền của web app -->
    <meta name="apple-mobile-web-app-title" content="MediLabor">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <!-- Mô tả của web app -->
    <meta name="apple-mobile-web-app-description" content="Ứng dụng quản lý bán hàng của MediLabor">
    <!-- Ảnh hiển thị khi thêm vào màn hình Home -->
    <link rel="apple-touch-icon" href="{{ asset('admin/images/logo.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Sign in') }} - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- Toastify -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/toastify/toastify.css') }}">
    <!-- Include sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/pages/auth.css') }}">
    <link rel="shortcut icon" href="{{asset('admin/images/logo/logo.png') }}" type="image/x-icon">
    <script src="{{ asset('admin/vendors/jquery/jquery.min.js ') }}"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register(`{{ asset('js/service-worker.js') }}`).then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    console.error('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            @yield('content')
        </div>

    </div>
</body>

    <!-- Include sweetalert2 JS -->
    <script src="{{ asset('admin/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- Include Toastify -->
    <script src="{{ asset('admin/vendors/toastify/toastify.js') }}"></script>
</html>