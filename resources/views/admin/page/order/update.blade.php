@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Chỉnh sửa đơn hàng</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="#" enctype="multipart/form-data">
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
                                               placeholder="Tên người nhận" value="{{ $order->shipping_name ?? '' }}">
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
                                               name="shipping_phone" value="{{ $order->shipping_phone ?? '' }}"
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
                                               name="shipping_email" value="{{ $order->shipping_email ?? '' }}"
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
                                               name="shipping_address" value="{{ $order->shipping_address ?? '' }}"
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
                                        <textarea class="form-control" id="note" rows="5" name="note">{{ $order->note ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="product-list">
                                @foreach($order->orderDetails as $key => $item)
                                    <div class="row product-entry mb-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="product" style="margin-bottom: 5px">Sản phẩm:</label>
                                                <select class="form-control product-select" name={{ 'products['.$key.'][product_id]' }}>
                                                    <option selected>{{ $item->product?->name ?? '' }}</option>
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
                                                <input type="number" class="form-control quantity-input" value="{{ $item->quantity ?? '' }}"
                                                       name={{ 'products['.$key.'][quantity]' }} value="1" min="1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="price" style="margin-bottom: 5px">Số tiền:</label>
                                                <input type="text" value="{{ $item->sub_total ?? '' }}" class="form-control price-display" name={{ 'products['.$key.'][sub_total]' }} readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" style="margin-top: 25px">

                                                <button type="button" class="btn btn-danger btn-remove">x</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-12">
                                   <button type="button" class="btn btn-outline-primary btn-add">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.order.showIndex') }}">Hủy</a>
                    <button class="btn btn-secondary" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
