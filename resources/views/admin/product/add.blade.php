@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-plus-circle"></i> THÊM SẢN PHẨM
                    </h3>
                </div>
                <form action="/admin/product/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="iPhone X">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'description' );
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="image" name="image"
                                    placeholder="/content/images/uploads/iphone-x.png">

                                <div class="input-group-append">
                                    <label class="input-group-text btn btn-primary"
                                            for="image_file" id="uploadBtn">Chọn file</label>
                                    <input type="file" class="form-control-file d-none"
                                            id="image_file" name="image_file">
                                </div>
                            </div>
                            <img id="previewImg" class="img-fluid" alt="" style="display:none;width:30%;">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group table-responsive">
                            <label>Danh sách biến thể sản phẩm</label>
                            <table class="table table-head-fixed text-nowrap">
                                <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Giá giảm</th>
                                    <th>Mô tả ngắn</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $generateId = md5(time()); @endphp
                                <tr>
                                    <td><input required type="text" class="form-control" name="variant_name[]"></td>
                                    <td><input required type="number" class="form-control" name="variant_quantity[]"></td>
                                    <td><input required type="text" class="form-control format-price" name="variant_price[]"></td>
                                    <td><input required type="text" class="form-control format-price" name="variant_discount_price[]"></td>
                                    <td><input required type="text" class="form-control" name="variant_description[]"></td>
                                    <td><div class="input-group mb-3">
                                            <input required type="text" class="form-control" id="image_{{ $generateId }}" name="variant_image[]" value="">
                                            <div class="input-group-append">
                                                <label class="input-group-text btn btn-primary" for="image_file_{{ $generateId }}">Chọn file</label>
                                                <input type="file" class="form-control-file d-none"
                                                       id="image_file_{{ $generateId }}" onchange="uploadImage('{{ $generateId }}')">
                                            </div>
                                        </div>
                                        <img id="previewImg_{{ $generateId }}" class="img-fluid" style="width:100px;" src="">
                                    </td>
{{--                                    <td><input required type="file" name="variant_image[]" accept="image/*"></td>--}}
                                    <td><button type="button" class="btn btn-danger" onclick="deleteVariantRow(this)">Xóa</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-info" onclick="addVariantRow()">Thêm biến thể</button>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            $(".format-price").priceFormat({
                limit: 15,
                prefix: '',
                centsLimit: 0
            });
        });

        function generateRandomString(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        function addVariantRow() {
            const generateId = generateRandomString(11);

            const table = document.querySelector('table tbody');
            const newRow = `
				<tr>
					<td><input required type="text" class="form-control" name="variant_name[]"></td>
					<td><input required type="number" class="form-control" name="variant_quantity[]"></td>
					<td><input required type="text" class="form-control format-price" name="variant_price[]"></td>
					<td><input required type="text" class="form-control format-price" name="variant_discount_price[]"></td>
                    <td><input required type="text" class="form-control" name="variant_description[]"></td>
                    <td><div class="input-group mb-3">
                            <input required type="text" class="form-control" id="image_${generateId}" name="variant_image[]" value="">
                            <div class="input-group-append">
                                <label class="input-group-text btn btn-primary" for="image_file_${generateId}">Chọn file</label>
                                    <input type="file" class="form-control-file d-none" id="image_file_${generateId}" onchange="uploadImage('${generateId}')">
                            </div>
                        </div>
                        <img id="previewImg_${generateId}" class="img-fluid" alt="" style="width:100px;"src="">
                    </td>
                    <td><button type="button" class="btn btn-danger" onclick="deleteVariantRow(this)">Xóa</button></td>
				</tr>
			`;
            table.insertAdjacentHTML('beforeend', newRow);
            $(".format-price").priceFormat({
                limit: 15,
                prefix: '',
                centsLimit: 0
            });
        }

        function deleteVariantRow(button) {
            const row = button.closest('tr');
            row.remove();
        }

        function uploadImage(id) {
            let image = $('#image_file_'+id+'').prop('files')[0];
            let formData = new FormData();
            formData.append('image', image);

            $.ajax({
                url: '/admin/images/upload/',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.path){
                        $('#image_'+id+'').val(data.path);
                        $('#previewImg_'+id+'').attr('src', data.path);
                        $('#previewImg_'+id+'').show();
                    }else{
                        $('#image_'+id+'').val('');
                        $('#previewImg_'+id+'').attr('src', '');
                        $('#previewImg_'+id+'').hide();
                    }

                }
            });
        }

        $('#image_file').on('change', function() {
            let image = $('#image_file').prop('files')[0];
            let formData = new FormData();
            formData.append('image', image);

            $.ajax({
                url: '/admin/images/upload/',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if(data.path){
                        $('#image').val(data.path);
                        $('#previewImg').attr('src', data.path);
                        $('#previewImg').show();
                    }else{
                        $('#image').val('');
                        $('#previewImg').attr('src', '');
                        $('#previewImg').hide();
                    }

                }
            });
        });
    </script>
@endsection
