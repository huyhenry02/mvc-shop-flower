@extends('shop.layouts.main')
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Đăng nhập</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Đăng nhập</li>
        </ol>
    </div>

    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="bg-light rounded shadow p-5">
                        <div class="text-center mb-4">
                            <h2 class="text-primary">Chào mừng bạn trở lại</h2>
                            <p class="text-muted">Hãy đăng nhập để tiếp tục.</p>
                        </div>
                        <form action="{{ route('auth.postLogin') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg border-secondary" placeholder="Nhập email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg border-secondary" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                                </div>
                                <a href="#" class="text-primary text-decoration-none">Quên mật khẩu?</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-3">Đăng nhập</button>
                        </form>
                        <p class="text-center mt-4 mb-0">Chưa có tài khoản? <a href="{{ route('auth.showRegister') }}" class="text-primary text-decoration-none">Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
