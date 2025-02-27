@extends('shop.layouts.main')
@section('content')
    <div class="container-fluid page-header py-5 bg-primary">
        <h1 class="text-center text-white display-6 fw-bold">Đăng ký</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#" class="text-white-50">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Đăng ký</li>
        </ol>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="bg-light rounded shadow p-5">
                    <div class="text-center mb-4">
                        <h2 class="text-primary">Tạo tài khoản mới</h2>
                        <p class="text-muted">Hãy điền thông tin bên dưới để đăng ký.</p>
                    </div>
                    <form action="{{ route('auth.postRegister') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" id="name" name="name"
                                   class="form-control form-control-lg border-secondary"
                                   placeholder="Nhập họ và tên của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                   class="form-control form-control-lg border-secondary"
                                   placeholder="Nhập địa chỉ email của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" id="phone" name="phone"
                                   class="form-control form-control-lg border-secondary"
                                   placeholder="Nhập số điện thoại của bạn" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" id="password" name="password"
                                   class="form-control form-control-lg border-secondary" placeholder="Nhập mật khẩu"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" id="confirm_password"
                                   class="form-control form-control-lg border-secondary" placeholder="Nhập lại mật khẩu"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3">Đăng ký</button>
                    </form>
                    <p class="text-center mt-4 mb-0">Đã có tài khoản? <a href="{{ route('auth.showLogin') }}"
                                                                         class="text-primary text-decoration-none">Đăng
                            nhập</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
