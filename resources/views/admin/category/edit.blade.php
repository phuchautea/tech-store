@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-edit"></i> CHỈNH SỬA DANH MỤC #{{ $category->id }}
                    </h3>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Bánh Kem" value="{{ $category->name }}">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea class="form-control" id="description"
                                    name="description">{{ $category->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="image" name="image"
                                    placeholder="/content/images/uploads/banh-mini.png"
                                    value="{{ $category->image }}">

                                <div class="input-group-append">
                                    <label class="input-group-text btn btn-primary"
                                            for="image_file" id="uploadBtn">Chọn file</label>
                                    <input type="file" class="form-control-file d-none"
                                            id="image_file" name="image_file">
                                </div>
                            </div>
                            <img id="previewImg" class="img-fluid" alt="" style="width:30%;"
                                    src="{{ $category->image }}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="0">Danh mục cha</option>
                                @foreach($categories as $categoryParent)
                                    <option value="{{ $categoryParent->id }}" {{ $category->parent_id == $categoryParent->id ? 'selected' : '' }}>{{ $categoryParent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kích hoạt</label>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="1" type="radio" id="status" name="status" {{ $category->status == 1 ? 'checked' : '' }}>
                                    <label for="status" class="custom-control-label">Có</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" value="0" type="radio" id="de_status" name="status" {{ $category->status == 0 ? 'checked' : '' }}>
                                    <label for="de_status" class="custom-control-label">Không</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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