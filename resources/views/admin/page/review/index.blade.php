@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div class="w-100">
            <h3 class="fw-bold mb-3">Danh sách đánh giá</h3>
            <input
                type="text"
                placeholder="Tìm kiếm đánh giá"
                class="form-control search-input w-25"
                id="search-input"
            />
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="category-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="5%">STT</th>
                        <th scope="col">Tên người đánh giá</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Đánh giá</th>
                        <th scope="col">Nội dung</th>
                        <th class="text-center" scope="col" width="10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
