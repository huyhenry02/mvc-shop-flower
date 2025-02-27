@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thêm mới đơn hàng</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('admin.order.postCreate') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="shipping_name">Tên người nhận<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="shipping_name" name="shipping_name"
                                               placeholder="Tên người nhận">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="shipping_phone">SĐT người nhận<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="shipping_phone"
                                               name="shipping_phone"
                                               placeholder="SĐT người nhận">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="shipping_email">Email người nhận<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="shipping_email"
                                               name="shipping_email"
                                               placeholder="Email người nhận">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="shipping_address">Địa chỉ người nhận<span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="shipping_address"
                                               name="shipping_address"
                                               placeholder="Địa chỉ người nhận">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="note">Ghi chú</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="note" rows="5" name="note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="product-list">
                                <div class="row product-entry mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product" style="margin-bottom: 5px">Sản phẩm:</label>
                                            <select class="form-control product-select" name="products[0][product_id]">
                                                <option selected>Chọn sản phẩm</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}"
                                                            data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="quantity" style="margin-bottom: 5px">Số lượng:</label>
                                            <input type="number" class="form-control quantity-input"
                                                   name="products[0][quantity]" value="1" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="price" style="margin-bottom: 5px">Số tiền:</label>
                                            <input type="text" class="form-control price-display" name="products[0][sub_total]" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group" style="margin-top: 25px">
                                            <button type="button" class="btn btn-success btn-add">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.order.showIndex') }}">Hủy</a>
                    <button class="btn btn-secondary" type="submit">Thêm đơn hàng</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let productIndex = 1;

            function updatePrice(row) {
                const productSelect = row.querySelector('.product-select');
                const quantityInput = row.querySelector('.quantity-input');
                const priceDisplay = row.querySelector('.price-display');

                const selectedOption = productSelect.options[productSelect.selectedIndex];
                const pricePerUnit = parseFloat(selectedOption.dataset.price || 0);
                const quantity = parseInt(quantityInput.value) || 1;

                priceDisplay.value = (pricePerUnit * quantity).toLocaleString('vi-VN');
            }

            document.getElementById('product-list').addEventListener('change', function (event) {
                if (event.target.classList.contains('product-select') || event.target.classList.contains('quantity-input')) {
                    const row = event.target.closest('.product-entry');
                    updatePrice(row);
                }
            });

            document.getElementById('product-list').addEventListener('click', function (event) {
                if (event.target.classList.contains('btn-add')) {
                    const row = event.target.closest('.product-entry');
                    const newRow = row.cloneNode(true);

                    newRow.querySelectorAll('input, select').forEach(input => {
                        input.name = input.name.replace(/\[\d+\]/, `[${productIndex}]`);
                        if (input.type === 'text') input.value = '';
                        if (input.type === 'number') input.value = 1;
                    });

                    document.getElementById('product-list').appendChild(newRow);
                    productIndex++;
                }
            });

            document.querySelectorAll('.product-entry').forEach(row => updatePrice(row));
        });
    </script>
@endsection
