@extends('admin.layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <div class="container-fluid">
        <h2 class='mb-5'>{{ $pageName }}</h2>
        <div class="row justify-content-center">
            <div class="col-12">
                @if (session('response') && session('response')['status'] == 'success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check"></i>
                        {!! session('response')['msg'] !!}
                        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                    </div>
                @elseif (session('response'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-xmark"></i>
                        {!! session('response')['msg'] !!}
                        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
                    </div>
                @endif
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a class="nav-link{!! Request::path() === 'admin/setting/general' ? ' active" aria-current="page' : '' !!}" href="{{ route('admin.setting', ['key' => 'general']) }}">Cài đặt chung</a>
                    </li>
                    @foreach (App\Models\Language::all() as $language)
                        <li class="nav-item">
                            <a class="nav-link{!! Request::path() === 'admin/setting/' . $language->code ? ' active" aria-current="page' : '' !!}" href="{{ route('admin.setting', ['key' => $language->code]) }}">{{ $language->name }}</a>
                        </li>
                    @endforeach
                </ul>
                @if (Request::path() === 'admin/setting/general')
                <div class="card mb-4">
                    <form id="setting-form" action="{{ route('admin.setting.email') }}" method="post">
                        @csrf
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Email settings') }}</h3>
                            <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="app_name">{{ __('App name') }}<br />
                                    <small class="form-text text-muted" id="app_name-help">Hiển thị trên tiêu đề website, email</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('app_name') is-invalid @enderror" id="app_name" name="app_name" type="text" value="{{ config('app.name') }}">
                                    @error('app_name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_from_address">{{ __('Notification Email') }}<br />
                                    <small class="form-text text-muted" id="mail_from_address-help">Dùng để gửi thông báo đơn hàng, thông báo đặt dịch vụ</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_from_address') is-invalid @enderror" id="mail_from_address" name="mail_from_address" type="text" value="{{ config('mail.from.address') }}">
                                    @error('mail_from_address')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_username">{{ __('Username') }}<br />
                                    <small class="form-text text-muted" id="mail_username-help">Tên đăng nhập máy chủ gửi đi của toàn bộ email hệ thống</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_username') is-invalid @enderror" id="mail_username" name="mail_username" type="text" value="{{ config('mail.mailers.smtp.username') }}">
                                    @error('mail_username')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_password">{{ __('Application password') }}<br />
                                    <small class="form-text text-muted" id="mail_password-help">Mật khẩu đăng nhập máy chủ gửi toàn bộ email của hệ thống</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_password') is-invalid @enderror" id="mail_password" name="mail_password" type="text" value="{{ config('mail.mailers.smtp.password') }}">
                                    @error('mail_password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_encryption">{{ __('Type of Encryption') }}<br />
                                    <small class="form-text text-muted" id="mail_encryption-help">Áp dụng cho việc mã hoá email gửi đi, đảm bảo tính bảo mật</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_encryption') is-invalid @enderror" id="mail_encryption" name="mail_encryption" type="text" value="{{ config('mail.mailers.smtp.encryption') }}">
                                    @error('mail_encryption')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_driver">{{ __('Mail driver') }}<br />
                                    <small class="form-text text-muted" id="mail_driver-help">Giao thức áp dụng cho việc gửi toàn bộ email của hệ thống</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_driver') is-invalid @enderror" id="mail_driver" name="mail_driver" type="text" value="{{ config('mail.mailers.smtp.transport') }}">
                                    @error('mail_driver')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_port">{{ __('Mail port') }}<br />
                                    <small class="form-text text-muted" id="mail_port-help">Cổng mạng sẽ dùng để gửi email hệ thống</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_port') is-invalid @enderror" id="mail_port" name="mail_port" type="text" value="{{ config('mail.mailers.smtp.port') }}">
                                    @error('mail_port')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="mail_host">{{ __('Mail host') }}<br />
                                    <small class="form-text text-muted" id="mail_host-help">Máy chủ xử lý thực hiện toàn bộ việc gửi email của hệ thống</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('mail_host') is-invalid @enderror" id="mail_host" name="mail_host" type="text" value="{{ config('mail.mailers.smtp.host') }}">
                                    @error('mail_host')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mb-4">
                    <form id="setting-form" action="{{ route('admin.setting.recaptcha') }}" method="post">
                        @csrf
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Recaptcha settings') }}</h3>
                            <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="recaptchav3_secret">{{ __('Secret key') }}<br />
                                    <small class="form-text text-muted" id="recaptchav3_secret-help">Mã bí mật do Google Recaptcha v3 cung cấp</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('recaptchav3_secret') is-invalid @enderror" id="recaptchav3_secret" name="recaptchav3_secret" type="text" value="{{ env('RECAPTCHAV3_SECRET') }}">
                                    @error('recaptchav3_secret')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="recaptchav3_sitekey">{{ __('Site key') }}<br />
                                    <small class="form-text text-muted" id="recaptchav3_sitekey-help">Mã xác minh do Google Recaptcha v3 cung cấp</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('recaptchav3_sitekey') is-invalid @enderror" id="recaptchav3_sitekey" name="recaptchav3_sitekey" type="text" value="{{ env('RECAPTCHAV3_SITEKEY') }}">
                                    @error('recaptchav3_sitekey')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="recaptchav3_origin">{{ __('Origin URL') }}<br />
                                    <small class="form-text text-muted" id="recaptchav3_origin-help">URL truy cập Google Recaptcha v3</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('recaptchav3_origin') is-invalid @enderror" id="recaptchav3_origin" name="recaptchav3_origin" type="text" value="{{ env('RECAPTCHAV3_ORIGIN') }}">
                                    @error('recaptchav3_origin')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="recaptchav3_locale">{{ __('App locale') }}<br />
                                    <small class="form-text text-muted" id="recaptchav3_locale-help">Khu vực vận hành</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('recaptchav3_locale') is-invalid @enderror" id="recaptchav3_locale" name="recaptchav3_locale" type="text" value="{{ env('RECAPTCHAV3_LOCALE') }}">
                                    @error('recaptchav3_locale')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mb-4">
                    <form id="setting-form" action="{{ route('admin.setting.social') }}" method="post">
                        @csrf
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Social settings') }}</h3>
                            <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="social_facebook">{{ __('Facebook') }}<br />
                                    <small class="form-text text-muted" id="social_facebook-help">Nhập URL trang Facebook</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('social_facebook') is-invalid @enderror" id="social_facebook" name="social_facebook" type="text" value="{{ isset($settings['social_facebook']) ? $settings['social_facebook'] : '' }}">
                                    @error('social_facebook')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="social_zalo">{{ __('Zalo') }}<br />
                                    <small class="form-text text-muted" id="social_zalo-help">Nhập số điện thoại Zalo</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('social_zalo') is-invalid @enderror" id="social_zalo" name="social_zalo" type="text" value="{{ isset($settings['social_zalo']) ? $settings['social_zalo'] : '' }}">
                                    @error('social_zalo')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="social_youtube">{{ __('Youtube') }}<br />
                                    <small class="form-text text-muted" id="social_youtube-help">Nhập URL kênh Youtube</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('social_youtube') is-invalid @enderror" id="social_youtube" name="social_youtube" type="text" value="{{ isset($settings['social_youtube']) ? $settings['social_youtube'] : '' }}">
                                    @error('social_youtube')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="social_whatsapp">{{ __('Whatsapp') }}<br />
                                    <small class="form-text text-muted" id="social_whatsapp-help">Nhập số điện thoại Whatsapp</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('social_whatsapp') is-invalid @enderror" id="social_whatsapp" name="social_whatsapp" type="text" value="{{ isset($settings['social_whatsapp']) ? $settings['social_whatsapp'] : '' }}">
                                    @error('social_whatsapp')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="social_telegram">{{ __('Telegram') }}<br />
                                    <small class="form-text text-muted" id="social_telegram-help">Nhập URL kênh Telegram</small>
                                </label>
                                <div class="col-sm-8">
                                    <input class="form-control @error('social_telegram') is-invalid @enderror" id="social_telegram" name="social_telegram" type="text" value="{{ isset($settings['social_telegram']) ? $settings['social_telegram'] : '' }}">
                                    @error('social_telegram')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card mb-4">
                    <form id="setting-form" action="{{ route('admin.setting.code') }}" method="post">
                        @csrf
                        <div class="card-header d-flex justify-content-between">
                            <h3>{{ __('Other settings') }}</h3>
                            <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="head_code">{{ __('Code embed inside <head> tag') }}<br />
                                    <small class="form-text text-muted" id="head_code-help">Nhúng các đoạn mã tracking hoặc mã bổ sung giữa cặp thẻ <kbd>&lt;head&gt;&lt;/head&gt;</kbd></small>
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('head_code') is-invalid @enderror" id="head_code" name="head_code" type="text" rows="10">{{ isset($settings['head_code']) ? $settings['head_code'] : '' }}</textarea>
                                    @error('head_code')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="body_top_code">{{ __('Code embed on top of <body> tag') }}<br />
                                    <small class="form-text text-muted" id="body_top_code-help">Nhúng các đoạn mã tracking hoặc mã bổ sung ngay sau thẻ <kbd>&lt;body&gt;</kbd></small>
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('body_top_code') is-invalid @enderror" id="body_top_code" name="body_top_code" type="text" rows="10">{{ isset($settings['body_top_code']) ? $settings['body_top_code'] : '' }}</textarea>
                                    @error('body_top_code')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="body_bottom_code">{{ __('Code embed end of <body> tag') }}<br />
                                    <small class="form-text text-muted" id="body_bottom_code-help">Nhúng các đoạn mã bổ sung ngay trước thẻ <kbd>&lt;/body&gt;</kbd></small>
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('body_bottom_code') is-invalid @enderror" id="body_bottom_code" name="body_bottom_code" type="text" rows="10">{{ isset($settings['body_bottom_code']) ? $settings['body_bottom_code'] : '' }}</textarea>
                                    @error('body_bottom_code')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-4 col-form-label" for="contact_map">{{ __('Code embed Google Maps to contact page') }}<br />
                                    <small class="form-text text-muted" id="contact_map-help">Nhúng bản đồ Google Maps vào trang liên hệ</small>
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control @error('contact_map') is-invalid @enderror" id="contact_map" name="contact_map" type="text" rows="10">{{ isset($settings['contact_map']) ? $settings['contact_map'] : '' }}</textarea>
                                    @error('contact_map')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @else
                    <div class="card mb-4">
                        <form id="setting-form" action="{{ route('admin.setting.popup') }}" method="post">
                            @csrf
                            <div class="card-header d-flex justify-content-between">
                                <h3>{{ __('Popup settings') }}</h3>
                                <input name="language_id" type="hidden" value="{{ $settings['language_id'] }}">
                                <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-2">
                                        <div class="mb-3 row">
                                            <label class="col-sm-8 col-form-label" for="popup_enabled">{{ __('Kích hoạt popup') }}<br />
                                                <small class="form-text text-muted" id="popup-enabled-help">Bật popup tất cả trang</small>
                                            </label>
                                            <div class="col-sm-4 d-flex align-items-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input @error('popup_enabled') is-invalid @enderror" id="popup_enabled" name="popup_enabled" type="checkbox" role="switch"
                                                        @if (isset($settings['popup_enabled']) && $settings['popup_enabled']) checked @endif>
                                                    @error('popup_enabled')
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label" for="popup-visibility">{{ __('Tần suất hiển thị') }}<br />
                                                <small class="form-text text-muted" id="popup-visibility-help">Số lần hiển thị mỗi session</small>
                                            </label>
                                            <div class="col-sm-8 d-flex align-items-center">
                                                <select class="form-control @error('popup_visibility') is-invalid @enderror" id="popup-visibility" name="popup_visibility">
                                                    <option value="always" {{ isset($settings['popup_visibility']) && $settings['popup_visibility'] == 'always' ? 'selected' : '' }}>Luôn luôn</option>
                                                    <option value="once" {{ isset($settings['popup_visibility']) && $settings['popup_visibility'] == 'once' ? 'selected' : '' }}>Một lần</option>
                                                </select>
                                                @error('popup_visibility')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="mb-3 row">
                                            <label class="col-sm-6 col-form-label" for="popup-delay">{{ __('Độ trễ popup') }}<br />
                                                <small class="form-text text-muted" id="popup-delay-help">Thời gian chờ popup hiển thị</small>
                                            </label>
                                            <div class="col-sm-6 d-flex align-items-center">
                                                <div class="input-group">
                                                    <input class="form-control @error('popup_delay') is-invalid @enderror" id="popup-delay" name="popup_delay" type="text"
                                                        value="{{ isset($settings['popup_delay']) ? $settings['popup_delay'] : '' }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">milisecond</span>
                                                    </div>
                                                </div>
                                                @error('popup_delay')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <textarea class="form-control summernote @error('popup_content') is-invalid @enderror" id="popup-content" name="popup_content" type="text" rows="10">{{ isset($settings['popup_content']) ? $settings['popup_content'] : '' }}</textarea>
                                        @error('popup_content')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-4">
                        <form id="setting-form" action="{{ route('admin.setting.company') }}" method="post">
                            @csrf
                            <div class="card-header d-flex justify-content-between">
                                <h3>{{ __('Company information settings') }}</h3>
                                <input name="language_id" type="hidden" value="{{ $settings['language_id'] }}">
                                <button class="btn btn-primary btn-save" type="submit">{{ __('Save') }}</button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_name">{{ __('Company name') }}<br />
                                        <small class="form-text text-muted" id="company_name-help">Hiển thị tại các vị trí cố định: trang liên hệ, footer website, chân email... </small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" type="text" value="{{ isset($settings['company_name']) ? $settings['company_name'] : '' }}">
                                        @error('company_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_address">{{ __('Company address') }}<br />
                                        <small class="form-text text-muted" id="company_address-help">Hiển thị tại các vị trí: footer website, chân email...</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_address') is-invalid @enderror" id="company_address" name="company_address" type="text"
                                            value="{{ isset($settings['company_address']) ? $settings['company_address'] : '' }}">
                                        @error('company_address')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_hotline">{{ __('Company hotline') }}<br />
                                        <small class="form-text text-muted" id="company_hotline-help">Hiển thị tại trang liên hệ, header website, footer website, footer email...</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_hotline') is-invalid @enderror" id="company_hotline" name="company_hotline" type="text"
                                            value="{{ isset($settings['company_hotline']) ? $settings['company_hotline'] : '' }}">
                                        @error('company_hotline')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_phone">{{ __('Company phone') }}<br />
                                        <small class="form-text text-muted" id="company_phone-help">Hiển thị tại trang liên hệ, footer website...</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_phone') is-invalid @enderror" id="company_phone" name="company_phone" type="text"
                                            value="{{ isset($settings['company_phone']) ? $settings['company_phone'] : '' }}">
                                        @error('company_phone')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_tax_id">{{ __('Company tax id') }}<br />
                                        <small class="form-text text-muted" id="company_tax_id-help">Hiển thị tại trang liên hệ</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_tax_id') is-invalid @enderror" id="company_tax_id" name="company_tax_id" type="text"
                                            value="{{ isset($settings['company_tax_id']) ? $settings['company_tax_id'] : '' }}">
                                        @error('company_tax_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_tax_meta">{{ __('Company tax meta') }}<br />
                                        <small class="form-text text-muted" id="company_tax_meta-help">Hiển thị tại trang liên hệ</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_tax_meta') is-invalid @enderror" id="company_tax_meta" name="company_tax_meta" type="text"
                                            value="{{ isset($settings['company_tax_meta']) ? $settings['company_tax_meta'] : '' }}">
                                        @error('company_tax_meta')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label" for="company_email">{{ __('Company email') }}<br />
                                        <small class="form-text text-muted" id="company_email-help">Hiển thị tại trang liên hệ, footer website</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input class="form-control @error('company_email') is-invalid @enderror" id="company_email" name="company_email" type="text"
                                            value="{{ isset($settings['company_email']) ? $settings['company_email'] : '' }}">
                                        @error('company_email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-save').click(function() {
                $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2 mt-1" id="spinner-form" role="status"></span> {{ __('Waiting') }}');
                $(this).parents('form').submit();
            })

            $('.summernote').next('.note-editor').find('.note-editable').css('height', '300px');
        })
    </script>
@endpush
