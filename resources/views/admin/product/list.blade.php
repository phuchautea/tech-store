@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-list"></i> DANH SÁCH SẢN PHẨM - Tổng: {{ $total_records }}
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
                                    <th>Danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Tạo lúc</th>
                                    <th>Cập nhật lúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td style="width: 100px">
                                            <a href="/admin/product/edit/{{ $product->id }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a onclick="removeRow({{ $product->id }}, '/admin/product/destroy')"
                                                href="#" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->slug }}</td>
                                        <td><img src="{{ $product->image }}" class="img-fluid" style="width:100px"></td>
                                        <?php $category = \App\Models\Category::find($product->category_id); ?>
                                        <td>{{ $category->name }}</td>
                                        <td><textarea rows="3" class="form-control">{{ $product->description }}</textarea></td>
                                        <td>{!! $productService->status($product->status) !!}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
