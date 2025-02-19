@extends('shop.layouts.main')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" id="search_product" class="form-control p-3"
                                       placeholder="Tìm kiếm ..." aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i
                                        class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="filter_price">Sắp xếp theo:</label>
                                <select id="filter_price" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                        form="fruitform">
                                    <option value="asc">Giá từ cao đến thấp</option>
                                    <option value="desc">Giá từ thấp đến cao</option>
                                    <option value="max">Lượt mua nhiều nhất</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Danh mục sản phẩm</h4>
                                        <ul class="list-unstyled category-list">
                                            @foreach( $categories as $category )
                                                <li class="category-item">
                                                    <label class="category-label">
                                                        <input class="form-check-input category-checkbox" id="category_id" type="checkbox" value="{{ $category->id }}">
                                                        <span class="category-name">{{ $category->name ?? '' }}</span>
                                                    </label>
                                                    <span class="category-count">{{ $category->products()->count() ?? 0 }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-2">Giá</h4>
                                        <input type="range" class="form-range w-100" id="range_input" name="range_input"
                                               min="50000" max="1000000" value="0"
                                               oninput="amount.value=range_input.value">
                                        <output id="amount" name="amount" min-velue="50000" max-value="1000000"
                                                for="rangeInput">0
                                        </output>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Sản phẩm nổi bật</h4>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="/shop/img/featur-1.jpg" class="img-fluid rounded" alt="">
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
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="/shop/img/featur-2.jpg" class="img-fluid rounded" alt="">
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
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="/shop/img/featur-3.jpg" class="img-fluid rounded" alt="">
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
                                        <a href="#"
                                           class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew
                                            More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="/shop/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute"
                                             style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center">
                                @foreach( $products as $product )
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="{{ $product->detail_image ?? '' }}"
                                                     class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                 style="top: 10px; left: 10px;">{{ $product->category?->name ?? '' }}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{ $product->name ?? '' }}</h4>
                                                <p>{{ $product->description ?? '' }}</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">{{ number_format($product->price) ?? 0}}
                                                        VNĐ</p>
                                                    <div class="d-flex">
                                                        <form action="{{ route('customer.addToCart') }}" method="post">
                                                            @csrf
                                                            <button
                                                                class="btn border border-secondary rounded-pill px-3 text-primary"
                                                                type="submit"><i
                                                                    class="fa fa-shopping-bag text-primary"></i>
                                                                <input type="hidden" name="product_id"
                                                                       value="{{ $product->id }}">
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('customer.showProductDetail', $product->id) }}"
                                                           class="btn border border-secondary rounded-pill px-3 text-secondary"><i
                                                                class="fa fa-eye text-secondary"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        @if ($products->onFirstPage())
                                            <a href="#" class="rounded disabled">&laquo;</a>
                                        @else
                                            <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
                                        @endif

                                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                                            <a href="{{ $products->url($i) }}"
                                               class="rounded {{ ($products->currentPage() == $i) ? 'active' : '' }}">{{ $i }}</a>
                                        @endfor

                                        @if ($products->hasMorePages())
                                            <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
                                        @else
                                            <a href="#" class="rounded disabled">&raquo;</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
    <style>
        .category-list {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .category-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .category-item:hover {
            background: #f8f9fa;
        }

        .category-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 16px;
            color: green;
            font-weight: 500;
        }

        .category-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #0275d8;
            cursor: pointer;
        }

        .category-count {
            font-size: 14px;
            font-weight: bold;
            color: #6c757d;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetchFilteredProducts() {
                let selectedCategories = [];
                document.querySelectorAll(".category-checkbox:checked").forEach((checkbox) => {
                    selectedCategories.push(checkbox.value);
                });

                let searchQuery = document.getElementById("search_product").value;
                let filterPrice = document.getElementById("filter_price").value;
                let minPrice = document.getElementById("range_input").value;

                let url = "{{ route('customer.filterProducts') }}";

                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        categories: selectedCategories,
                        search: searchQuery,
                        filter_price: filterPrice,
                        // min_price: minPrice
                    })
                })

            }
        });

    </script>
@endsection
