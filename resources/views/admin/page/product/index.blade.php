@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div class="w-100">
            <h3 class="fw-bold mb-3">Danh sách sản phẩm</h3>
            <div class="d-flex">
                <input
                    type="text"
                    placeholder="Tìm kiếm sản phẩm"
                    class="form-control search-input w-25"
                    id="search-input"
                />
                <div class="input-group">
                    <select class="form-select" id="categories-id" name="category_id">
                        <option value="" selected>Loại sản phẩm</option>
                        @foreach($categories as $category)
                            <option id="category-id" value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    @if (Session::has('deleteProduct'))
        <div class="alert alert-success">
            {{ Session::get('deleteProduct') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="product-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="5%">STT</th>
                        <th scope="col">Mã sản phẩm</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Loại sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Ảnh</th>
                        <th class="text-center" scope="col" width="15%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->code ?? '' }}</td>
                            <td>{{ $product->name ?? '' }}</td>
                            <td>{{ $product->category->name ?? ''}}</td>
                            <td>{{ number_format($product->price) ?? 0}} VNĐ</td>
                            <td>
                                <img src="{{ $product->detail_image ?? '' }}" alt="{{ $product->name }}" width="100">
                            </td>
                            <td class="text-center">
                                <a href="{{ route('customer.showProductDetail', $product->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{route("admin.product.getDelete", $product->id)}}"
                                   class="btn btn-sm btn-danger" onClick = 'return confirm("Bạn có chắc chắn muốn xoá không?")'>
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            function fetchProducts() {
                var queryInput = $('#search-input').val();
                var querySelectOption = $('#categories-id').val();

                $.ajax({
                    url: '{{ route('admin.product.search') }}',
                    method: 'GET',
                    data: {
                        queryInput: queryInput,
                        querySelectOption: querySelectOption
                    },
                    success: function (response) {
                        $('#product-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            }
            $('#search-input').on('change keyup', function () {
                fetchProducts(); // Gọi hàm tìm kiếm khi nhập text
            });
            $('#categories-id').on('change', function () {
                fetchProducts(); // Gọi hàm tìm kiếm khi chọn danh mục
            });
        });
    </script>
@endsection
