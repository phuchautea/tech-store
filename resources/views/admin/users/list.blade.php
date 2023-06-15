@extends('admin.main')
@section('content')
    @foreach($users as $user)
        <div class="modal fade" id="setRole_{{ $user->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Set role user #{{ $user->email }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role_{{ $user->id }}">
                                        @foreach($role_list as $role)
                                            <option value="{{ $role['id'] }}" {{ $user->role == $role['id'] ? 'selected' : '' }}>{{ $role['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" id="btn_set_role_{{ $user->id }}" onclick="setRole({{ $user->id }});">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-list"></i> DANH SÁCH NGƯỜI DÙNG - Tổng: {{ $total_records }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Hành động</th>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Tạo lúc</th>
                                    <th>Cập nhật lúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td style="width: 100px">
                                            <a href="#" class="btn btn-primary btn-sm"
                                               data-toggle="modal" data-target="#setRole_{{ $user->id }}">
                                                <i class="fa fa-users"></i>
                                            </a>
                                            <a onclick="removeRow({{ $user->id }}, '/admin/user/destroy')"
                                               href="#" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{!! $userService->role($user->role) !!}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function setRole(id){
            $.ajax({
                url: "/admin/user/edit/"+id+"",
                type: "POST",
                dataType: "TEXT",
                data : {
                    role : $('#role_'+id+'').val(),
                    id : id,
                },
                success : function (result){
                    var result = JSON.parse(result);
                    if(result['status'] == false){
                        alert(result['message']);
                        $("#btn_set_role_"+id+"").html('Cập nhật').attr('disabled', false);
                    }else{
                        alert(result['message']);
                        $("#btn_set_role_"+id+"").html('Thành công').attr('disabled', true);
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }
    </script>
@endsection
