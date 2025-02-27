<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
        <ul class="nav nav-secondary">
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#user"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý người dùng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse show" id="user">
                    <ul class="nav nav-collapse">
                        <li class="">
                            <a href="{{ route('admin.user.showIndex') }}">
                                <span class="sub-item">Danh sách người dùng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#category"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý danh mục</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse show" id="category">
                    <ul class="nav nav-collapse">
                        <li class="">
                            <a href="{{ route('admin.category.showIndex') }}">
                                <span class="sub-item">Danh sách danh mục</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.category.showCreate') }}">
                                <span class="sub-item">Thêm mới danh mục</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#product"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý sản phẩm</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse show" id="product">
                    <ul class="nav nav-collapse">
                        <li class="">
                            <a href="{{ route('admin.product.showIndex') }}">
                                <span class="sub-item">Danh sách sản phẩm</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.product.showCreate') }}">
                                <span class="sub-item">Thêm mới sản phẩm</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#order"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý đơn hàng</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse show" id="order">
                    <ul class="nav nav-collapse">
                        <li class="">
                            <a href="{{ route('admin.order.showIndex') }}">
                                <span class="sub-item">Danh sách đơn hàng</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="{{ route('admin.order.showCreate') }}">
                                <span class="sub-item">Thêm mới đơn hàng</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a
                    data-bs-toggle="collapse"
                    href="#review"
                    class="collapsed"
                    aria-expanded="false"
                >
                    <i class="fas fa-bars"></i>
                    <p>Quản lý đánh giá</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse show" id="review">
                    <ul class="nav nav-collapse">
                        <li class="">
                            <a href="{{ route('admin.review.showIndex') }}">
                                <span class="sub-item">Danh sách đánh giá</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
