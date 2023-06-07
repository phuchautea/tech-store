@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-list"></i> DANH SÁCH DANH MỤC - Tổng: {{ $total_records }}
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
                                    <th>Slug</th>
                                    <th>Hình</th>
                                    <th>Mô tả</th>
                                    <th>Tạo lúc</th>
                                    <th>Cập nhật lúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td style="width: 100px">
                                            <a href="/admin/category/edit/{{ $category->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="removeRow({{ $category->id }}, '/admin/category/destroy')"
                                                href="#" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            @if ($category->parent_id != 0)
                                                <?php
                                                    $parentCategory = \App\Models\Category::find($category->parent_id);
                                                    echo $parentCategory ? $parentCategory->name .' |-- ' : '';
                                                ?>
                                                {{ $category->name }}
                                            @else
                                                {{ $category->name }}
                                            @endif
                                        </td>
                                        <td>{{ $category->slug }}</td>
                                        <td><img src="{{ $category->image }}" class="img-fluid" style="width:100px"></td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $categories->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
