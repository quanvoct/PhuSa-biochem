<header>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a class="burger-btn d-block" href="#">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item dropdown me-1 d-flex align-items-center">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <input type="text" id="search" placeholder="🔍 Search">
                        </a>
                    </li> 
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-bell-fill  bi-sub fs-4 text-gray-600"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications</h6>
                            </li>
                            <li><a class="dropdown-item">No notification available</a></li>
                        </ul>
                    </li> --}}
                </ul>
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->name }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->getRoleNames()->first() }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{ Auth::user()->imageUrl }}">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">{{ __('Hello') }}, {{ Auth::user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('profile.index') }}">
                                <i class="icon-mid bi bi-person me-2"></i>
                                {{ __('Your profile') }}
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form class="d-none" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div class="container-fluid px-4 overflow-auto">
    <div style="min-width: 65rem">
        <div class="btn-group" role="group">
            @if (!empty(Auth::user()->can(app\Models\User::READ_ORDERS))) 
            <a class="btn btn-primary" href="{{ route('admin.order') }}">{{ __('Orders') }}</a>
            @endif
            @if (!empty(Auth::user()->can(app\Models\User::CREATE_ORDER))) 
            <a class="btn btn-primary btn-create-order cursor-pointer">{{ __('New order') }}</a>
            @endif
            @if (!empty(Auth::user()->can(app\Models\User::READ_TRANSACTIONS))) 
            <a class="btn btn-primary" href="{{ route('admin.transaction') }}">{{ __('Transactions') }}</a>
            @endif
            @if (!empty(Auth::user()->can(app\Models\User::CREATE_TRANSACTION))) 
            <a class="btn btn-primary btn-create-transaction cursor-pointer">{{ __('New transaction') }}</a>
            @endif
            @if (!empty(Auth::user()->can(app\Models\User::READ_DEBTS))) 
            <a class="btn btn-primary" href="{{ route('admin.debt') }}">{{ __('Debts') }}</a>
            @endif
        </div>
    </div>
</div>