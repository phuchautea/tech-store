@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-plus-circle"></i> THÊM DANH MỤC
                    </h3>
                </div>
                <form action="/admin/category/store" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Điện Thoại">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="image" name="image"
                                    placeholder="/content/images/uploads/dien-thoai.png">

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
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0">Danh mục cha</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
