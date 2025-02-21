@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Chỉnh sửa sản phẩm</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('admin.product.postUpdate', $product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="title">Tên sản phẩm <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name ?? '' }}"
                                               placeholder="Tên sản phẩm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="category_id">Loại sản phẩm <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="{{ $product->category_id ?? '' }}">{{ $product->category?->name ?? 'Chọn loại sản phẩm' }}</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price">Giá <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->price ?? '' }}"
                                               placeholder="Giá sản phẩm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" rows="5" name="description">{{ $product->description ?? ''      }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tags">Gắn tag</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tagInput" placeholder="Nhập tag và nhấn Enter">
                                    </div>
                                    <div id="tagContainer" class="mt-2"></div>
                                    <input type="hidden" id="tagValues" name="tags">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="content">Ảnh sản phẩm <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="detail_image" name="detail_image" accept="image/*"/>
                                    <div id="detail_image_preview" class="mt-2">
                                        @if(!empty($product->detail_image))
                                            <img src="{{ $product->detail_image }}" class="img-thumbnail" style="max-width: 100%; max-height: 150px;" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="content">Ảnh khác <span class="text-danger">*</span></label>
                                    <div class="row">
                                        @for ($i = 1; $i <= 3; $i++)
                                            <div class="col-3">
                                                <input type="file" class="form-control" id="detail_image_{{ $i }}" name="detail_image_{{ $i }}" accept="image/*"/>
                                                <div id="detail_image_preview_{{ $i }}" class="mt-2">
                                                    @php $imageField = "detail_image_$i"; @endphp
                                                    @if(!empty($product->$imageField))
                                                        <img src="{{$product->$imageField}}" class="img-thumbnail" style="max-width: 100%; max-height: 150px;" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-secondary" type="submit">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .tag {
            display: inline-flex;
            align-items: center;
            background-color: #f1f1f1;
            color: #333;
            border-radius: 20px;
            padding: 5px 10px;
            margin: 5px;
            font-size: 14px;
            font-weight: 500;
        }
        .tag span {
            margin-left: 10px;
            cursor: pointer;
            font-weight: bold;
            color: red;
        }

    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tagInput = document.getElementById("tagInput");
            const tagContainer = document.getElementById("tagContainer");
            const tagValues = document.getElementById("tagValues");
            let tags = [];

            let existingTags = "{{ $product->tags ?? '' }}".split(",");
            existingTags.forEach(tag => {
                if (tag.trim() !== "") tags.push(tag.trim());
            });
            updateTagDisplay();

            tagInput.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    const tagText = tagInput.value.trim();
                    if (tagText !== "" && !tags.includes(tagText)) {
                        tags.push(tagText);
                        updateTagDisplay();
                    }
                    tagInput.value = "";
                }
            });

            function updateTagDisplay() {
                tagContainer.innerHTML = "";
                tags.forEach((tag, index) => {
                    let tagElement = document.createElement("div");
                    tagElement.className = "tag";
                    tagElement.innerHTML = `${tag} <span onclick="removeTag(${index})">&times;</span>`;
                    tagContainer.appendChild(tagElement);
                });
                tagValues.value = tags.join(",");
            }

            window.removeTag = function(index) {
                tags.splice(index, 1);
                updateTagDisplay();
            };
        });

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
        @for ($i = 1; $i <= 3; $i++)
        document.getElementById('detail_image_{{ $i }}').addEventListener('change', function () {
            previewImage(this, 'detail_image_preview_{{ $i }}');
        });
        @endfor
    </script>
@endsection
