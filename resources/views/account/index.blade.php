@extends('main')
@section('bodyClass', 'product-template-default single single-product postid-3270 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
    <style>
        .container-fluid {
            display: flex;
            flex-direction: column;
            /*justify-content: center;*/
            height: 85vh;
        }
    </style>
    <div id="content" class="content-area page-wrapper" role="main">
        <div class="row row-main">
            <h1 style="color:red; text-align:center">TÀI KHOẢN CỦA BẠN</h1>
            <div class="col small-2 large-2">
                <ul class="list-unstyled">
                    @if(Auth::user()->role == 'admin')
                        <li class="current"><a href="/admin/">Panel Admin</a></li>
                    @endif
                    <li class="current"><a href="/account">Thông tin tài khoản</a></li>
                    <li class="last"><a href="/account/logout">Đăng xuất</a></li>
                </ul>
            </div>
            <div class="col small-10 large-10">
                <div class="col-inner">
                    <div class="page-layout">
                        <div class="wrapper-row pd-page">
                            <div class="container-fluid">

                                <div class="col-xs-12 customer-table-wrap" id="customer_orders">
                                    <div class="customer_order customer-table-bg">
                                        @if($orders->count() > 0)
                                            <p class="title-detail">
                                                Danh sách đơn hàng mới nhất
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th class="order_number text-center">Mã đơn hàng</th>
                                                        <th class="date text-center">Ngày đặt</th>
                                                        <th class="total text-right">Thành tiền</th>
                                                        <th class="payment_status text-center">Thanh toán</th>
                                                        <th class="fulfillment_status text-center">Trạng thái</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orders as $order)
                                                        <tr class="odd ">
                                                            <td class="text-center"><a href="/order/search/{{ $order->code }}">#{{ $order->code }}</a></td>
                                                            <td class="text-center"><span>{{ $order->created_at }}</span></td>
                                                            <td class="text-right"><span class="total money">{{ number_format($order->total_price) }}đ</span></td>
                                                            <td class="text-center">{!! $orderService->payment_status($order->payment_status) !!}</td>
                                                            <td class="text-center">{!! $orderService->status($order->status) !!}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <p style="text-align: center;">Bạn chưa đặt mua sản phẩm.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
