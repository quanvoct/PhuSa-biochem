@extends('layouts.app')
@section('title')
    {{ $pageName }}
@endsection
@section('content')
    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__breadcrumb-inner">
                        <h1 class="page-title">{{ $pageName }}</h1>
                        <div class="ltn__breadcrumb-list">
                            <ul>
                                <li><a href="{{ route('home.index') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                                <li>{{ $pageName }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BREADCRUMB AREA END -->
    <div class="liton__wishlist-area pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- PRODUCT TAB AREA START -->
                    <div class="ltn__product-tab-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="ltn__tab-menu-list mb-50">
                                        <div class="nav">
                                            <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_1">Dashboard <i class="fas fa-home"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_2">Orders <i class="fas fa-file-alt"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_3">Update information <i class="fas fa-user"></i></a>
                                            <a data-bs-toggle="tab" href="#liton_tab_1_4">Change Password <i class="fas fa-key"></i></a>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="liton_tab_1_1">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="row align-items-end mb-3">
                                                    <div class="col-6 col-lg-3 text-center">
                                                        <form action="{{ route('profile.save', ['key' => 'avatar']) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <label class="avt cursor-pointer" for="profile-avatar">
                                                                <img class="rounded-circle" src="{{ Auth::user()->imageUrl }}" alt="Admin" style="object-fit: cover; width: 150px; height: 150px;">
                                                            </label>
                                                            <input name="id" type="hidden" value="{{ Auth::user()->id }}">
                                                            <input class="d-none" id="profile-avatar" name="image" type="file" accept="image/*">
                                                        </form>
                                                    </div>
                                                    <div class="col col-lg-9">
                                                        <p>Hello <strong>{{ Auth::user()->name }}</strong> (not <strong>{{ Auth::user()->name }}</strong>? <small><a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a></small> )</p>
                                                    </div>
                                                </div>
                                                <p>{{ __('Full name:') }} <strong>{{ Auth::user()->name }}</strong></p>
                                                <p>{{ __('Email:') }} <strong>{{ Auth::user()->email }}</strong></p>
                                                <p>{{ __('Phone:') }} <strong>{{ Auth::user()->phone }}</strong></p>
                                                <p>{{ __('Address:') }} <strong>{{ Auth::user()->address }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_2">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Order</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th>Total</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_3">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>The following addresses will be used on the checkout page by default.</p>

                                                <form action="{{ route('profile.save', ['key' => 'settings']) }}" method="post">
                                                    @csrf
                                                    <div class="card mb-3">
                                                        @if (session('response'))
                                                            <div class="alert alert-{{ session('response')['status'] }} alert-dismissible fade show text-white" role="alert">
                                                                <i class="fas fa-check"></i>
                                                                {!! session('response')['msg'] !!}
                                                                <button class="btn-close" data-bs-dismiss="alert" type="button" arial-label="Close"></button>
                                                            </div>
                                                        @endif
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Full name') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('name') is-invalid @enderror" id="profile-name" name="name" type="text" value="{{ Auth::user()->name ?? old('name') }}">
                                                                    @error('name')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Email') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('email') is-invalid @enderror" id="profile-email" name="email" type="email" value="{{ Auth::user()->email ?? old('email') }}"
                                                                        inputmode="email">
                                                                    @error('email')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Phone') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('phone') is-invalid @enderror" id="profile-phone" name="phone" type="text" value="{{ Auth::user()->phone ?? old('phone') }}"
                                                                        inputmode="numeric">
                                                                    @error('phone')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Address') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('address') is-invalid @enderror @error('address') is-invalid @enderror" id="profile-address" name="address" type="text"
                                                                        value="{{ Auth::user()->address ?? old('address') }}">
                                                                    @error('address')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Password') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('password') is-invalid @enderror" id="profile-password" name="password" type="password" placeholder="confirmation password"
                                                                        autocomplete="new-password">
                                                                    @error('password')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-12 d-flex justify-content-center mt-4">
                                                                    <input name="id" type="hidden" value="{{ Auth::user()->id }}">
                                                                    <button class="btn btn-effect-1 text-uppercase theme-btn-1" type="submit">{{ __('Update') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="liton_tab_1_4">
                                            <div class="ltn__myaccount-tab-content-inner">
                                                <p>Change password.</p>
                                                <form action="{{ route('profile.save', ['key' => 'password']) }}" method="post">
                                                    @csrf
                                                    <div class="card mb-3">
                                                        @if (session('response'))
                                                            <div class="alert alert-{{ session('response')['status'] }} alert-dismissible fade show text-white" role="alert">
                                                                <i class="fas fa-check"></i>
                                                                {!! session('response')['msg'] !!}
                                                                <button class="btn-close" data-bs-dismiss="alert" type="button" arial-label="Close"></button>
                                                            </div>
                                                        @endif
                                                        <div class="card-body">
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Current password:') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('current_password') is-invalid @enderror" id="profile-current-password" name="current_password" type="password">
                                                                    @error('current_password')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('New password:') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('password') is-invalid @enderror" name="password" type="password" autocomplete="new-password">
                                                                    @error('password')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-3">
                                                                    <h6 class="mb-0">{{ __('Confirm new password:') }}</h6>
                                                                </div>
                                                                <div class="col-sm-9 text-secondary">
                                                                    <input class="form-control mb-2 @error('password') is-invalid @enderror" name="password_confirmation" type="password" autocomplete="new-password">
                                                                    @error('password_confirmation')
                                                                        <span class="invalid-feedback d-block" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-sm-12 d-flex justify-content-center">
                                                                    <input name="id" type="hidden" value="{{ Auth::user()->id }}">
                                                                    <button class="btn btn-effect-1 text-uppercase theme-btn-1" type="submit">{{ __('Update') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- PRODUCT TAB AREA END -->
                </div>
            </div>
        </div>
    </div>
    <!-- WISHLIST AREA START -->
@endsection

@push('scripts')
    <script>
        $('#profile-avatar').change(function(e) {
            e.preventDefault()
            const form = $(this).parents('form')
            src = URL.createObjectURL(document.getElementById('profile-avatar').files[0])
            $(this).parents('form').find('img').attr('src', src)
            submitForm(form)
        })
    </script>
@endpush
