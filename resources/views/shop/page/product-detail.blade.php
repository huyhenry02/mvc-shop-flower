@extends('shop.layouts.main')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">{{ $product->name ?? '' }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('customer.showIndex') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="#">Sản phẩm</a></li>
            <li class="breadcrumb-item active text-white">Chi tiết sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="border rounded">
                                    <img src="{{ $product->detail_image ?? '' }}" class="img-fluid rounded" alt="Image" id="mainImage">
                            </div>
                            <div class="d-flex mt-3">
                                <img src="{{ $product->detail_image_1 ?? $product->detail_image }}" class="img-thumbnail me-2 small-img" style="width: 80px; cursor: pointer;" onclick="changeImage(this)" alt="">
                                <img src="{{ $product->detail_image_2 ?? $product->detail_image }}" class="img-thumbnail me-2 small-img" style="width: 80px; cursor: pointer;" onclick="changeImage(this)" alt="">
                                <img src="{{ $product->detail_image_3 ?? $product->detail_image }}" class="img-thumbnail me-2 small-img" style="width: 80px; cursor: pointer;" onclick="changeImage(this)" alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name ?? '' }}</h4>
                            <p class="mb-3">Danh mục: {{ $product->category?->name ?? '' }}</p>
                            <h5 class="fw-bold mb-3">{{ number_format($product->price) ?? 0}} VNĐ</h5>
                            <div class="mb-3">
                                @foreach( explode(',', $product->tags) as $tag )
                                    <span class="badge bg-primary">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{{ $product->description ?? '' }}</p>
                            <form action="{{ route('customer.addToCart') }}" method="post">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" class="form-control form-control-sm text-center border-0 input-visible-quantity" name="quantity" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                @csrf
                                <button class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary"
                                        type="submit">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i>Thêm vào giỏ hàng
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                </button>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">ĐÁNH GIÁ
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-mission" role="tabpanel"
                                     aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Jason Smith</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Sam Peters</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        <form action="#">
                            <h4 class="mb-5 fw-bold">Để lại đánh giá của bạn</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4"
                                               placeholder="Tên của bạn *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0" placeholder="Số điện thoại *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8"
                                                  placeholder="Nội dung *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                        </div>
                                        <a href="#"
                                           class="btn border border-secondary text-primary rounded-pill px-4 py-3">
                                            Gửi</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <h4 class="mb-4">Sản phẩm nổi bật</h4>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded" style="width: 100px; height: 100px;">
                                    <img src="{{ $product->detail_image ?? '' }}" class="img-fluid rounded" alt="Image">
                                </div>
                                <div>
                                    <h6 class="mb-2">Big Banana</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2">2.99 $</h5>
                                        <h5 class="text-danger text-decoration-line-through">4.11 $</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-4">
                                <a href="{{ route('customer.showProducts') }}"
                                   class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem
                                    thêm</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="/shop/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function changeImage(element) {
            document.getElementById('mainImage').src = element.src;
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-plus').forEach(function (btnPlus) {
                btnPlus.addEventListener('click', function (e) {
                    e.preventDefault();
                    const input = btnPlus.closest('.input-group').querySelector('.input-visible-quantity');
                    let currentValue = parseInt(input.value) || 0;
                    input.value = currentValue + 1 - 1;
                });
            });

            document.querySelectorAll('.btn-minus').forEach(function (btnMinus) {
                btnMinus.addEventListener('click', function (e) {
                    e.preventDefault();
                    const input = btnMinus.closest('.input-group').querySelector('.input-visible-quantity');
                    let currentValue = parseInt(input.value) || 0;
                    const minValue = parseInt(input.min) || 1;
                    if (currentValue > minValue) {
                        input.value = currentValue - 1 + 1;
                    }
                });
            });
        });
    </script>
@endsection
