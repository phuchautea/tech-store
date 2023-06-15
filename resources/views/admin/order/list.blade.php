@extends('admin.main')
@section('content')
    @foreach($orders as $order)
    <div class="modal fade" id="edit_{{ $order->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chỉnh sửa đơn hàng #{{ $order->code }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tình trạng thanh toán</label>
                                <select class="form-control" id="payment_status_{{ $order->id }}">
                                    @foreach($payment_status_list as $payment_status)
                                    <option value="{{ $payment_status['id'] }}" {{ $order->payment_status == $payment_status['id'] ? 'selected' : '' }}>{{ $payment_status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tình trạng đơn hàng</label>
                                <select class="form-control" id="status_{{ $order->id }}">
                                    @foreach($status_list as $status)
                                    <option value="{{ $status['id'] }}" {{ $order->status == $status['id'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="btn_edit_{{ $order->id }}" onclick="update({{ $order->id }});">Lưu thay đổi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="orderDetails_{{ $order->id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng #{{ $order->code }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng </th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $order_details)
                                <tr>
                                    <td>{{ $order_details->product_name }}</td>
                                    <td>{{ number_format($order_details->price) }}đ</td>
                                    <td>{{ $order_details->quantity }}</td>
                                    <td>{{ number_format($order_details->total_price) }}đ</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
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
                        <i class="fa fa-list"></i> DANH SÁCH ĐƠN HÀNG - Tổng: {{ $total_records }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card-body table-responsive p-0" style="text-align: center">
                        <table class="table table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Hành động</th>
                                    <th>ID</th>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Phương thức</th>
                                    <th>Thanh toán</th>
                                    <th>Tổng tiền</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Tạo lúc</th>
                                    <th>Cập nhật lúc</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)

                                    <tr>
                                        <td style="width: 100px">
                                            <a href="#" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#edit_{{ $order->id }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm"
                                                data-toggle="modal" data-target="#orderDetails_{{ $order->id }}">
                                                <i class="fa fa-list"></i>
                                            </a>
                                        </td>
                                        <td>{{ $order->id }}</td>
                                        <td><a href="/order/search/{{ $order->code }}">#{{ $order->code }}</a></td>
                                        <td>
                                            {{ $order->name }}<br />
                                            {{ $order->address }}<br />
                                            {{ $order->email }}<br />
                                            {{ $order->phoneNumber }}<br />
                                        </td>
                                        <td><img style="width:22px" src="/storage/images/payment/{{ $order->payment_method }}.png"></td>
                                        <td>{!! $orderService->payment_status($order->payment_status) !!}</td>
                                        <td>{{ number_format($order->total_price) }}đ</td>
                                        <td>{{ $order->note }}</td>
                                        <td>{!! $orderService->status($order->status) !!}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <ul class="pagination pagination-sm m-0 float-right">
                        {{ $orders->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function update(id){
            $.ajax({
                url: "/admin/order/edit/"+id+"",
                type: "POST",
                dataType: "TEXT",
                data : {
                    payment_status : $('#payment_status_'+id+'').val(),
                    status : $('#status_'+id+'').val(),
                    id : id,
                },
                success : function (result){
                    var result = JSON.parse(result);
                    if(result['status'] == false){
                        alert(result['message']);
                        $("#btn_edit_"+id+"").html('Cập nhật').attr('disabled', false);
                    }else{
                        alert(result['message']);
                        $("#btn_edit_"+id+"").html('Thành công').attr('disabled', true);
                        setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }
    </script>
@endsection
