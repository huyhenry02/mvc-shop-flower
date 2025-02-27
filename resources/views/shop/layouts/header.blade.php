@php use App\Models\User; @endphp
<div class="container-fluid fixed-top">
    <div class="container topbar d-none d-lg-block">
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="" class="navbar-brand"><h1 class="text-primary display-6">HDFlowers</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('customer.showIndex') }}" class="nav-item nav-link {{ request()->routeIs('customer.showIndex') ? 'active' : '' }}">Trang chủ</a>
                    <a href="{{ route('customer.showProducts') }}" class="nav-item nav-link {{ request()->routeIs('customer.showProducts') ? 'active' : '' }}">Sản phẩm</a>
                    <a href="{{ route('customer.showContact') }}" class="nav-item nav-link {{ request()->routeIs('customer.showContact') ? 'active' : '' }}">Liên lạc</a>
                </div>
                <div class="d-flex m-3 me-0">
                    @if( auth()->user() )
                        <a href="{{ route('customer.showCart') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                {{ auth()->user()->cartItems->count() ?? 0 }}
                            </span>
                        </a>
                        <div class="dropdown my-auto">
                            <a href="#" class="dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                @if( auth()->user()->role === User::ROLE_ADMIN )
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.user.showIndex') }}">Trang quản
                                            trị</a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('customer.showYourOrder') }}">Xem đơn hàng
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('auth.showLogin') }}" class="btn btn-primary me-3">Đăng nhập</a>
                        <a href="{{ route('auth.showRegister') }}" class="btn btn-outline-primary">Đăng ký</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
