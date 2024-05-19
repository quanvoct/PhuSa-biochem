<div id="sidebar" class="active">
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
                        <span>Bảng tin</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="bi bi-currency-exchange"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="submenu ">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_ORDERS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.order') }}">Đơn hàng</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_TRANSACTIONS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.transaction') }}">Giao dịch</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_TRANSACTIONS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.debt') }}">Công nợ</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="bi bi-postcard-heart-fill"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="submenu ">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_PRODUCTS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.product') }}">Sản phẩm</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_CATALOGUES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.catalogue') }}">Danh mục</a>
                            </li>
                        @endif
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a class='sidebar-link cursor-pointer'>
                        <i class="bi bi-gear"></i>
                        <span>Quản lý hệ thống</span>
                    </a>
                    <ul class="submenu">
                        @if (!empty(Auth::user()->can(App\Models\User::READ_USERS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.user') }}">Tài khoản</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_ROLES)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.role') }}">Phân quyền</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_SETTINGS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.setting') }}">Cài đặt</a>
                            </li>
                        @endif
                        @if (!empty(Auth::user()->can(App\Models\User::READ_LOGS)))
                            <li class="submenu-item">
                                <a href="{{ route('admin.log') }}">Nhật ký</a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
