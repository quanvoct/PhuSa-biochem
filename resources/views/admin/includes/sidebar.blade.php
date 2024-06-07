<div id="sidebar" class="">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
                <div class="toggler text-end">
                    <a class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            <div class="justify-content-between">
                <div class="logo">
                    <a href="{{ route('home.index') }}"><img src="{{ asset('/admin/images/logo.svg') }}" alt="Logo" srcset="" class="img-fluid"></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-item ">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="icon-mid bi bi-currency-exchange"></i>
                        <span>{{ __('Sales management') }}</span>
                    </a>
                    <ul class="submenu">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_ORDERS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.order') }}">{{ __('Orders') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_TRANSACTIONS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.transaction') }}">{{ __('Transactions') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_TRANSACTIONS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.debt') }}">{{ __('Debts') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="icon-mid bi bi-box2-heart-fill"></i>
                        <span>{{ __('Shop management') }}</span>
                    </a>
                    <ul class="submenu">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_PRODUCTS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.product') }}">{{ __('Products') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_CATALOGUES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.catalogue') }}">{{ __('Catalogues') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="bi bi-newspaper"></i>
                        <span>{{ __('Content management') }}</span>
                    </a>
                    <ul class="submenu ">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_POSTS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.post') }}">{{ __('Posts') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_POSTS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.page') }}">{{ __('Pages') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_CATEGORIES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.category') }}">{{ __('Categories') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_IMAGES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.image') }}">{{ __('Images') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="bi bi-gear"></i>
                        <span>{{ __('System settings') }}</span>
                    </a>
                    <ul class="submenu">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_USERS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.user') }}">{{ __('Users') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_ROLES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.role') }}">{{ __('Roles') }}</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_SETTINGS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.setting', ['key' => 'general']) }}">{{ __('Settings') }}</a>
                            </li>
                        @endif
                            <li class="submenu-item">
                                <a href="{{ route('admin.language', ['key' => 'en']) }}">{{ __('Languages') }}</a>
                            </li>
                        @if (!empty(Auth::user()->can(App\Models\User::READ_LOGS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.log') }}">{{ __('Logs') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
