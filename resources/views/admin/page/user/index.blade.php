@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div class="w-100">
            <h3 class="fw-bold mb-3">Danh sách Người dùng</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="user-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="5%">STT</th>
                        <th scope="col">Họ và Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
