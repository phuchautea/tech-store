@php
    $include_breadcrumbs = true;
    $total = 0;
    if(isset($carts)){
        if(count($carts) > 0){
            $hasProduct = 1;
        }else{
            $hasProduct = 0;
        }
    }else{
        $hasProduct = 0;
    }

@endphp
@extends('main')
@section('bodyClass', 'product-template-default single single-product postid-3270 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
<div id="content" class="content-area page-wrapper" role="main">
    <div class="row row-main">
        <div class="large-12 col">
            <div class="col-inner">
                <div class="woocommerce">
                    <div class="woocommerce-notices-wrapper"></div>
                    <div class="woocommerce-form-coupon-toggle">
                        <div class="woocommerce-info message-wrapper">
                            <div class="message-container container medium-text-center">
                                Bạn có mã ưu đãi? <a href="#" class="showcoupon">Ấn vào đây để nhập mã</a> </div>
                        </div>
                    </div>
                    <form class="checkout_coupon woocommerce-form-coupon has-border is-dashed" method="post" style="display:none">
                        <p>Nếu bạn có mã giảm giá, vui lòng điền vào phía bên dưới.</p>
                        <div class="coupon">
                            <div class="flex-row medium-flex-wrap">
                                <div class="flex-col flex-grow">
                                    <input type="text" name="coupon_code" class="input-text" placeholder="Mã ưu đãi" id="coupon_code" value="" />
                                </div>
                                <div class="flex-col">
                                    <button type="submit" class="button expand" name="apply_coupon" value="Áp dụng">Áp dụng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="woocommerce-notices-wrapper"></div>
                    <div name="checkout"  class="checkout woocommerce-checkout">
                        <div class="row pt-0 ">
                            <div class="large-3 col"></div>
                            <div class="large-6 col">
                                <div class="woocommerce">
                                    <div class="woocommerce-notices-wrapper"></div>
                                    <div class="woocommerce row row-large row-divided">
                                        <div class="col large-7 pb-0 cart-auto-refresh">
                                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="/updateCart" enctype="multipart/form-data">
                                                @csrf
                                                <div class="cart-wrapper sm-touch-scroll">
                                                    @if($hasProduct == 1)
                                                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-name" colspan="3">Sản phẩm</th>
                                                                <th class="product-price">Giá</th>
                                                                <th class="product-quantity">Số lượng</th>
                                                                <th class="product-subtotal">Tạm tính</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($products as $product)
                                                            @php
                                                                $cartItemId = $product['cartItemId'];
                                                                $quantity = $product['quantity'];
                                                                $product_details = $product['product_details'];
                                                                $product_variant = $product['product_variant'];
                                                                $price = $product_variant->discount_price > 0 ? $product_variant->discount_price : $product_variant->price;
                                                                $total += $price * $quantity;
                                                            @endphp
                                                            <tr class="woocommerce-cart-form__cart-item cart_item">
                                                                <td class="product-remove">
                                                                    <a href="/carts/delete/{{ $cartItemId }}" class="remove" aria-label="Xóa sản phẩm này" data-product_id="4877" data-product_sku="">&times;</a>
                                                                </td>
                                                                <td class="product-thumbnail">
                                                                    <a href="/product/{{ $product_details->slug }}">
                                                                    <img width="300" height="300" src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20300%20300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" data-src="{{ $product_details->image }}" class="lazy-load attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy" /></a>
                                                                </td>
                                                                <td class="product-name" data-title="Sản phẩm">
                                                                    <a href="/product/{{ $product_details->slug }}">
                                                                        {{ $product_details->name }}</a>
                                                                    <dl class="variation">
                                                                        <dt class="variation-Musc">Phân loại:</dt>
                                                                        <dd class="variation-Musc">
                                                                            <p>{{ $product_variant->name }}</p>
                                                                        </dd>
                                                                    </dl>
                                                                    <div class="show-for-small mobile-product-price">
                                                                        <span class="mobile-product-price__qty">{{ $quantity }} x
                                                                        </span>
                                                                        <span class="woocommerce-Price-amount amount"><bdi>{{ number_format($product_variant->discount_price > 0 ? $product_variant->discount_price : $product_variant->price) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                                    </div>
                                                                </td>
                                                                <td class="product-price" data-title="Giá">
                                                                    <span class="woocommerce-Price-amount amount"><bdi>{{ number_format($product_variant->discount_price > 0 ? $product_variant->discount_price : $product_variant->price) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                                </td>
                                                                <td class="product-quantity" data-title="Số lượng">
                                                                    <div class="quantity buttons_added form-minimal">
                                                                        <input type="button" value="-" class="minus button is-form" onclick="minusQuantity('{{ $cartItemId }}')">
                                                                        <input type="number" id="quantity[{{ $cartItemId }}]" class="input-text qty text" step="1" min="0" max="" name="quantity[{{ $cartItemId }}]" value="{{ $quantity }}" title="SL" size="4" placeholder="" inputmode="numeric" />
                                                                        <input type="button" value="+" class="plus button is-form" onclick="plusQuantity('{{ $cartItemId }}')">
                                                                    </div>
                                                                </td>
                                                                <td class="product-subtotal" data-title="Tạm tính">
                                                                    <span class="woocommerce-Price-amount amount"><bdi>{{ number_format($product_variant->discount_price > 0 ? $product_variant->discount_price : $product_variant->price * $quantity) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="6" class="actions">
                                                                    <div class="continue-shopping pull-left text-left">
                                                                        <a class="button-continue-shopping button primary is-outline" href="/">
                                                                            &#8592;&nbsp;Tiếp tục xem sản phẩm </a>
                                                                    </div>
                                                                    <button type="submit" class="button primary mt-0 pull-right small" value="Cập nhật giỏ hàng">Cập nhật giỏ hàng</button>
                                                                </td>
                                                            </tr>
                                                            <script>
                                                                // Plus number quantiy product detail
                                                                var plusQuantity = function(cartItemId) {
                                                                    if ( jQuery('input[name="quantity['+cartItemId+']"]').val() != undefined ) {
                                                                        var currentVal = parseInt(jQuery('input[name="quantity['+cartItemId+']"]').val());
                                                                        if (!isNaN(currentVal)) {
                                                                            jQuery('input[name="quantity['+cartItemId+']"]').val(currentVal + 1);
                                                                        } else {
                                                                            jQuery('input[name="quantity['+cartItemId+']"]').val(1);
                                                                        }
                                                                    }else {
                                                                        console.log('error: Not see element ' + jQuery('input[name="quantity['+cartItemId+']"]').val());
                                                                    }
                                                                }
                                                                // Minus number quantiy product detail
                                                                var minusQuantity = function(cartItemId) {
                                                                    if ( jQuery('input[name="quantity['+cartItemId+']"]').val() != undefined ) {
                                                                        var currentVal = parseInt(jQuery('input[name="quantity['+cartItemId+']"]').val());
                                                                        if (!isNaN(currentVal) && currentVal > 1) {
                                                                            jQuery('input[name="quantity['+cartItemId+']"]').val(currentVal - 1);
                                                                        }
                                                                    }else {
                                                                        console.log('error: Not see element ' + jQuery('input[name="quantity['+cartItemId+']"]').val());
                                                                    }
                                                                }
                                                            </script>
                                                        </tbody>
                                                    </table>
                                                    @else
                                                        <center>Chưa có sản phẩm nào trong giỏ hàng</center>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
{{--                                        <div class="cart-collaterals large-5 col pb-0">--}}
{{--                                            <div class="cart-sidebar col-inner ">--}}
{{--                                                <form class="checkout_coupon mb-0" method="post">--}}
{{--                                                    <div class="coupon">--}}
{{--                                                        <h3 class="widget-title"><i class="icon-tag"></i> Phiếu ưu--}}
{{--                                                            đãi</h3><input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Mã ưu đãi" /> <input type="submit" class="is-form expand" name="apply_coupon" value="Áp dụng" />--}}
{{--                                                    </div>--}}
{{--                                                </form>--}}
{{--                                                <div class="cart-sidebar-content relative"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="cart-footer-content after-cart-content relative"></div>
                                </div>
                                @if($hasProduct == 1)
                                <div class="col-inner has-border">
                                    <div class="checkout-sidebar sm-touch-scroll">
                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <tfoot>
{{--                                                    <tr class="cart-subtotal">--}}
{{--                                                        <th>Tạm tính</th>--}}
{{--                                                        <td><span class="woocommerce-Price-amount amount"><bdi>{{ number_format($total) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span>--}}
{{--                                                        </td>--}}
{{--                                                    </tr>--}}
                                                    <tr class="order-total">
                                                        <th>Tổng tiền</th>
                                                        <td><strong><span class="woocommerce-Price-amount amount"><bdi style="color:red">{{ number_format($total) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                @endif
                                @include('alerts')
                                @if($hasProduct == 1)
                                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="/order" enctype="multipart/form-data">
                                    @csrf
                                    <div id="customer_details">
                                        <div class="clear">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Thông tin thanh toán</h3>

                                                @if(!Auth::check())
                                                    <b>Bạn đã có tài khoản? <a href="{{ Route("login") }}" style="color:red">Đăng nhập</a></b>
                                                @endif
                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                    <p class="form-row form-row-wide" id="billing_name_field" data-priority="10">
                                                        <label for="billing_name" class="">Tên&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input value="@if(Auth::check()){{ Auth::user()->name }}@endif" type="text" class="input-text" name="billing_name" id="billing_name" placeholder="Họ và tên" required autocomplete="given-name" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-wide" id="billing_address_field" data-priority="50">
                                                        <label for="billing_address_1" class="">Địa chỉ nhận hàng&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input value="" type="text" class="input-text" name="billing_address" id="billing_address" placeholder="Số nhà, tổ" required autocomplete="address-line" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-wide" id="province_field" data-priority="50">
                                                        <label for="province" class="">Tỉnh<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <select class="form-control" id="province" name="province" required>
                                                                <option>---Chọn tỉnh---</option>
                                                            </select>
                                                        </span>
                                                    </p>
                                                    <input type="hidden" name="province_value" id="province_value">
                                                    <p class="form-row form-row-wide" id="district_field" data-priority="50">
                                                        <label for="district" class="">Quận/Huyện<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <select class="form-control" id="district" name="district" required>
                                                                <option>---Chọn quận/huyện---</option>
                                                            </select>
                                                        </span>
                                                    </p>
                                                    <input type="hidden" name="district_value" id="district_value">
                                                    <p class="form-row form-row-wide" id="ward_field" data-priority="50">
                                                        <label for="ward" class="">Phường/Xã<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <select class="form-control" id="ward" name="ward" required>
                                                                <option>---Chọn phường/xã---</option>
                                                            </select>
                                                        </span>
                                                    </p>
                                                    <input type="hidden" name="ward_value" id="ward_value">
                                                    <p class="form-row form-row-wide" id="billing_phone_field" data-priority="100">
                                                        <label for="billing_phone" class="">Số điện thoại&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input value="@if(Auth::check()){{ Auth::user()->phone }}@endif" type="tel" class="input-text" name="billing_phone" id="billing_phone" placeholder="Số điện thoại" required autocomplete="tel" />
                                                        </span>
                                                    </p>
                                                    <p class="form-row form-row-wide" id="billing_email_field" data-priority="110">
                                                        <label for="billing_email" class="">Địa chỉ email&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <input value="@if(Auth::check()){{ Auth::user()->email }}@endif" type="email" class="input-text" name="billing_email" id="billing_email" placeholder="Email nhận hóa đơn" required autocomplete="email username" />
                                                        </span>
                                                    </p>
                                                    <div class="form-group">
                                                        <label class="control-label">Phương thức thanh toán <abbr class="required" title="bắt buộc">*</abbr></label>
                                                        <div class="col-md-10">
                                                            <div class="custom-control custom-radio">
                                                                <input id="cash" name="payment" type="radio" class="custom-control-input" checked="" required value="cash">
                                                                <label class="custom-control-label" for="cash"><img style="width:30px" src="/storage/images/payment/cash.png"> Tiền mặt</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input id="momo" name="payment" type="radio" class="custom-control-input" required value="momo">
                                                                <label class="custom-control-label" for="momo"><img style="width:30px" src="/storage/images/payment/momo.png"> MoMo</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input id="vnpay" name="payment" type="radio" class="custom-control-input" required value="vnpay">
                                                                <label class="custom-control-label" for="vnpay"><img style="width:30px" src="/storage/images/payment/vnpay.png"> VNPay</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clear">
                                            <div class="woocommerce-shipping-fields">
                                            </div>
                                            <div class="woocommerce-additional-fields">
                                                <h3>Thông tin bổ sung</h3>
                                                <div class="woocommerce-additional-fields__field-wrapper">
                                                    <p class="form-row notes" id="order_comments_field" data-priority="">
                                                        <label for="order_comments" class="">Ghi chú đơn hàng&nbsp;<span class="optional">(tùy chọn)</span></label>
                                                        <span class="woocommerce-input-wrapper">
                                                            <textarea name="billing_notes" class="input-text" id="billing_notes" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="2" cols="5"></textarea>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="button alt" style="margin-top: 10px;">Đặt hàng</button>
                                </form>
                                @endif
                            </div>
                            <div class="large-3 col">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            // Lấy danh sách tỉnh
            $.ajax({
                url: 'https://api.phuchautea.com/public/VNAddress/province',
                type: 'GET',
                success: function(response) {
                    // Xử lý kết quả trả về
                    if (response.code === 200) {
                        var provinces = response.data;
                        // Sắp xếp theo ABC
                        provinces.sort(function(a, b) {
                            var nameA = a.ProvinceName.toUpperCase();
                            var nameB = b.ProvinceName.toUpperCase();
                            if (nameA < nameB) {
                                return -1;
                            }
                            if (nameA > nameB) {
                                return 1;
                            }
                            return 0;
                        });
                        // Lặp qua danh sách tỉnh/thành phố
                        for (var i = 0; i < provinces.length; i++) {
                            var province = provinces[i];

                            // Tạo phần tử option và thêm vào thẻ select
                            var option = $('<option>')
                                .val(province.ProvinceID)
                                .text(province.ProvinceName);

                            $('#province').append(option);
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

            /* Lấy danh sách quận/huyện */
            // Xử lý sự kiện khi chọn tỉnh/thành phố
            $('#province').on('change', function() {
                var selectedProvinceID = parseInt($(this).val());
                var selectedOption = $(this).find('option:selected');
                var provinceName = selectedOption.text();
                $('#province_value').val(provinceName);
                // Xóa danh sách quận/huyện hiện tại
                $('#district').empty();
                $('#district').append("<option>---Chọn quận/huyện---</option>");

                // Gọi API để lấy danh sách quận/huyện dựa trên ProvinceID
                $.ajax({
                    url: 'https://api.phuchautea.com/public/VNAddress/district',
                    type: 'GET',
                    data: {
                        "province_id": selectedProvinceID
                    },
                    success: function(response) {
                        if (response.code === 200) {

                            var districts = response.data;
                            // Sắp xếp theo ABC
                            districts.sort(function(a, b) {
                                var nameA = a.DistrictName.toUpperCase();
                                var nameB = b.DistrictName.toUpperCase();
                                if (nameA < nameB) {
                                    return -1;
                                }
                                if (nameA > nameB) {
                                    return 1;
                                }
                                return 0;
                            });
                            for (var i = 0; i < districts.length; i++) {
                                var district = districts[i];
                                var option = $('<option>')
                                    .val(district.DistrictID)
                                    .text(district.DistrictName);

                                $('#district').append(option);
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            /* Lấy danh sách phường/xã */
            // Xử lý sự kiện khi chọn quận/huyện
            $('#district').on('change', function() {
                var selectedDistrictID = parseInt($(this).val());
                var selectedOption = $(this).find('option:selected');
                var districtName = selectedOption.text();
                $('#district_value').val(districtName);
                // Xóa danh sách phường/xã hiện tại
                $('#ward').empty();
                $('#ward').append("<option>---Chọn phường/xã---</option>");

                // Gọi API để lấy danh sách phường/xã dựa trên ProvinceID
                $.ajax({
                    url: 'https://api.phuchautea.com/public/VNAddress/ward',
                    type: 'GET',
                    data: {
                        "district_id": selectedDistrictID
                    },
                    success: function(response) {
                        if (response.code === 200) {

                            var wards = response.data;
                            // Sắp xếp theo ABC
                            wards.sort(function(a, b) {
                                var nameA = a.WardName.toUpperCase();
                                var nameB = b.WardName.toUpperCase();
                                if (nameA < nameB) {
                                    return -1;
                                }
                                if (nameA > nameB) {
                                    return 1;
                                }
                                return 0;
                            });
                            for (var i = 0; i < wards.length; i++) {
                                var ward = wards[i];
                                var option = $('<option>')
                                    .val(ward.WardID)
                                    .text(ward.WardName);

                                $('#ward').append(option);
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            // Xử lý sự kiện khi chọn phường/xã
            $('#ward').on('change', function() {
                var selectedDistrictID = parseInt($(this).val());
                var selectedOption = $(this).find('option:selected');
                var wardName = selectedOption.text();
                $('#ward_value').val(wardName);
            });
        });
    </script>
@endsection
