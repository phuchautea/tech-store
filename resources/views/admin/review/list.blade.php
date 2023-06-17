@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-list"></i> DANH SÁCH ĐÁNH GIÁ - Tổng: {{ $total_records }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Hành động</th>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Sản phẩm</th>
                                    <th>Rating</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Tạo lúc</th>
                                    <th>Cập nhật lúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td style="width: 100px">
                                            <a onclick="removeRow({{ $review->id }}, '/admin/review/destroy')"
                                                href="#" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                        <td>{{ $review->id }}</td>
                                        <td>
                                            {{ $review->user->name }}<br>
                                            {{ $review->user->email }}
                                        </td>
                                        <td><a href="/product/{{ $review->product->slug }}">{{ $review->product->name }}</a></td>
                                        <td>
                                            <div class="rating">
                                                @php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <=(int)$review->rating) {
                                                        echo '<span class="fa fa-star checked"></span>';
                                                    } else {
                                                        echo '<span class="fa fa-star"></span>';
                                                    }
                                                }
                                                @endphp
                                            </div>
                                        </td>
                                        <td><input class="form-control" value="{{ $review->title }}"></td>
                                        <td><textarea class="form-control" rows="3">{{ $review->content }}</textarea></td>
                                        <td>{{ $review->created_at }}</td>
                                        <td>{{ $review->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <style>
                    .checked {
                        color: orange;
                    }
                </style>
                <div class="card-footer">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $reviews->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection