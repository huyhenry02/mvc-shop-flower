@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thêm mới sản phẩm</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Tên sản phẩm<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Tên sản phẩm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id">Loại sản phẩm</label>
                                    <div class="input-group">
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">Chọn loại sản phẩm</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tag_id">Gắn tag</label>
                                    <div class="input-group">
                                        <select class="form-select" id="tag_id" name="tag_id">
                                            <option value="">Chọn tag</option>
                                            @foreach( $tags as $tag )
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="price">Giá<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="price" name="price"
                                               placeholder="Giá sản phẩm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" rows="5" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="content">Ảnh sản phẩm<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="detail_image" name="detail_image"
                                           accept="image/*" required/>
                                    <div id="detail_image_preview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-secondary">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(input, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = '';
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '150px';
                    img.className = 'img-thumbnail';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('detail_image').addEventListener('change', function () {
            previewImage(this, 'detail_image_preview');
        });
    </script>
@endsection
