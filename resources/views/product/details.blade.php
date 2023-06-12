@php
$include_breadcrumbs = true;
@endphp
@extends('main')
@section('bodyClass', 'product-template-default single single-product postid-3270 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
<div class="shop-container">
    <div class="container">
        <div class="woocommerce-notices-wrapper"></div>
    </div>
    <div id="product-3270" class="product type-product post-3270 status-publish first instock product_cat-apple product_cat-dien-thoai product_cat-iphone-11-series product_tag-apple product_tag-chinh-hang product_tag-dien-thoai product_tag-gia-re product_tag-ipad product_tag-ipad-air product_tag-ipad-gen product_tag-ipad-mini product_tag-ipad-pro product_tag-iphone product_tag-laptop product_tag-macbook product_tag-macbook-air product_tag-macbook-pro product_tag-may-tinh-bang product_tag-uy-tin has-post-thumbnail sale shipping-taxable purchasable product-type-variable">
        <div class="product-container">
            <div class="product-main">
                <!-- code hiển thị tiêu đề sản phẩm -->
                <div class="row mb-0 content-row row-title show-pc">
                    <div class="col-title col-ct-same large-9 col">
                        <div class="box-name__box-product-name">
                            <h1 class="product-title product_title">{{ $product->name }}</h1>
                        </div>
                        <div class="box-name__box-raiting">
                        </div>
                    </div>
                </div>
                <!-- end code hiển thị tiêu đề sản phẩm -->
                <div class="row mb-0 content-row">
                    <div class="product-gallery large-4 col">
                        <div class="product-images relative mb-half has-hover woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
                            @if($product->maxDiscountPercentage() > 0)
                                <div class="badge-container is-larger absolute left top z-1">
                                    <div class="callout badge badge-circle">
                                        <div class="badge-inner secondary on-sale"><span class="onsale">-{{$product->maxDiscountPercentage()}}%</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="image-tools absolute top show-on-hover right z-3">
                            </div>

                            <figure class="woocommerce-product-gallery__wrapper product-gallery-slider slider slider-nav-small mb-half" data-flickity-options='{
                        "cellAlign": "center",
                        "wrapAround": true,
                        "autoPlay": true,
                        "prevNextButtons":true,
                        "adaptiveHeight": true,
                        "imagesLoaded": true,
                        "lazyLoad": 1,
                        "dragThreshold" : 15,
                        "pageDots": false,
                        "rightToLeft": false       }'>
                                <div data-thumb="{{ $product->image }}" class="woocommerce-product-gallery__image slide first">
                                    <a href="{{ $product->image }}">
                                        <img width="600" height="600" src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20600%20600%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" class="lazy-load wp-post-image skip-lazy" alt="" decoding="async" loading="lazy" title="{{ $product->name }}" data-src="{{ $product->image }}" data-large_image="{{ $product->image }}" data-large_image_width="600" data-large_image_height="600" />
                                    </a>
                                </div>
                                @foreach($product_variants as $product_variant)
                                <div data-thumb="{{ $product_variant->image }}" class="woocommerce-product-gallery__image slide">
                                    <a href="{{ $product_variant->image }}">
                                        <img width="600" height="600" src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20600%20600%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" class="lazy-load wp-post-image skip-lazy" alt="" decoding="async" loading="lazy" title="{{ $product_variant->name }}" data-src="{{ $product_variant->image }}" data-large_image="{{ $product_variant->image }}" data-large_image_width="600" data-large_image_height="600" />
                                    </a>
                                </div>
                                @endforeach
                            </figure>

                            <div class="image-tools absolute bottom left z-3">
                                <a href="#product-zoom" class="zoom-button button is-outline circle icon tooltip hide-for-small" title="Zoom">
                                    <i class="icon-expand"></i> </a>
                            </div>
                        </div>

                        <div class="product-thumbnails thumbnails slider row row-small row-slider slider-nav-small small-columns-4" data-flickity-options='{
        			"cellAlign": "left",
        			"wrapAround": false,
        			"autoPlay": true,
        			"prevNextButtons": true,
        			"asNavFor": ".product-gallery-slider",
        			"percentPosition": true,
        			"imagesLoaded": true,
        			"pageDots": false,
        			"rightToLeft": false,
        			"contain": true
        		}'>
                            <div class="col is-nav-selected first">
                                <a>
                                    <img src="{{ $product->image }}" alt="" width="300" height="300" class="attachment-woocommerce_thumbnail" />
                                </a>
                            </div>
                            @foreach($product_variants as $product_variant)
                            <div class="col">
                                <a>
                                    <img src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20300%20300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" data-src="{{ $product_variant->image }}" alt="" width="300" height="300" class="lazy-load attachment-woocommerce_thumbnail" />
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="product-info summary col-fit col-divided col entry-summary product-summary form-minimal">
                        <!-- code hiển thị tiêu đề sản phẩm -->
                        <div class="row mb-0 content-row row-title show-mobile">
                            <div class="col-title col-ct-same large-12 col">
                                <div class="box-name__box-product-name">
                                    <h1 class="product-title product_title">{{ $product->name }}</h1>
                                </div>
                            </div>
                        </div>
                        <!-- end code hiển thị tiêu đề sản phẩm -->
                        <style>
                            div.woocommerce-variation-price,
                            div.woocommerce-variation-availability,
                            div.hidden-variable-price {
                                height: 0px !important;
                                overflow: hidden;
                                position: relative;
                                line-height: 0px !important;
                                font-size: 0% !important;
                            }
                        </style>
                        <script>
                            jQuery(document).ready(function($) {
                                $('input.variation_id').change(function() {
                                    //Correct bug, I put 0
                                    if (0 != $('input.variation_id').val()) {
                                        $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">' + $('div.woocommerce-variation-availability').html() + '</p>');
                                        console.log($('input.variation_id').val());
                                    } else {
                                        $('p.price').html($('div.hidden-variable-price').html());
                                        if ($('p.availability'))
                                            $('p.availability').remove();
                                        console.log('NULL');
                                    }
                                });
                            });
                        </script>
                        {{-- <p class="price giabienthe"><del><span class="woocommerce-Price-amount amount"><bdi>15,900,000<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></del>
                            <ins><span class="woocommerce-Price-amount amount"><bdi>14,900,000<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></ins>
                        </p>
                        <div class="hidden-variable-price"><del><span class="woocommerce-Price-amount amount"><bdi>15,900,000<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></del>
                            <ins><span class="woocommerce-Price-amount amount"><bdi>14,900,000<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></ins>
                        </div> --}}
                        <form class="variations_form cart" action="/addToCart" method="post" enctype='multipart/form-data'>
                            @csrf
                            <table class="variations" cellspacing="0" role="presentation">
                                <tbody>
                                    <tr></tr>
                                    <tr>
                                        <th class="label"><label for="product_variant_id">Biến thể</label></th>
                                        <td class="value">
                                            <div class="variation-selector variation-select-ux_label hidden">
                                                <select id="product_variant_id" class="" onchange="checkSelectedVariants();" name="product_variant_id" data-attribute_name="product_variant_id" data-show_option_none="yes">
                                                    <option value="">Chọn một tùy chọn</option>
                                                    {{-- <option value="129gb" class="attached enabled">128GB (16,500,000₫)</option>
                                                    <option value="256gb" class="attached" disabled="">256GB (16,800,000₫)</option>
                                                    <option value="512gb" class="attached" disabled="">512GB (18,800,000₫)</option> --}}
                                                    @foreach($product_variants as $variant)
                                                        @if($variant->quantity > 0)
                                                            @if(!isset($selected1))
                                                                <option value="{{ $variant->id }}" class="attached" selected>{{ $variant->name }} ({{ number_format($variant->discount_price > 0 ? $variant->discount_price : $variant->price) }}₫)</option>
                                                                <?php $selected1 = true; ?>
                                                            @else
                                                                <option value="{{ $variant->id }}" class="attached">{{ $variant->name }} ({{ number_format($variant->discount_price > 0 ? $variant->discount_price : $variant->price) }}₫)</option>
                                                            @endif
                                                            {{-- <option value="{{ $variant->slug }}" class="attached">{{ $variant->name }} ({{ number_format($variant->price) }}₫)</option> --}}
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="ux-swatches ux-swatches-attribute-ux_label" data-attribute_name="product_variant_id">
                                                @foreach($product_variants as $variant)
                                                    @if(!isset($selected) && $variant->quantity > 0)
                                                    <div class="ux-swatch tooltip ux-swatch--image tooltipstered selected" data-value="{{ $variant->id }}" data-name="{{ $variant->name }} ({{ number_format($variant->discount_price > 0 ? $variant->discount_price : $variant->price) }}₫)">
                                                        <?php $selected = true; ?>
                                                    @else
                                                    <div class="ux-swatch tooltip ux-swatch--image tooltipstered" data-value="{{ $variant->id }}" data-name="{{ $variant->name }} ({{ number_format($variant->discount_price > 0 ? $variant->discount_price : $variant->price) }}₫)">
                                                    @endif
                                                        <img width="100" height="100" src="{{ $variant->image }}" class="ux-swatch__img attachment-woocommerce_gallery_thumbnail size-woocommerce_gallery_thumbnail" decoding="async" loading="lazy">
                                                        <span class="ux-swatch__text">
                                                            {{ $variant->name }}<br>
                                                            (@if($variant->discount_price > 0) <del>{{ number_format($variant->price) }}₫</del> @endif
                                                            {{ number_format($variant->discount_price > 0 ? $variant->discount_price : $variant->price) }}₫ )</span></div>
                                                @endforeach
                                                </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="single_variation_wrap">
                                <div class="woocommerce-variation single_variation"></div>
                                <div class="woocommerce-variation-add-to-cart variations_button">

                                    <div class="quantity buttons_added form-minimal">
                                        <input type="button" value="-" class="minus button is-form" onclick="minusQuantity()">
                                        <label class="screen-reader-text" for="quantity">{{ $product->name }}</label>
                                        <input type="number" id="quantity" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" size="4"/>
                                        <input type="button" value="+" class="plus button is-form" onclick="plusQuantity()">
                                    </div>

                                    <button type="submit" class="single_add_to_cart_button button alt wp-element-button">Thêm vào giỏ</button>

                                    <script>
                                        function checkSelectedVariants() {
                                            var addToCartBtn = document.querySelector('.single_add_to_cart_button');
                                            var variantSelected = document.querySelectorAll('.ux-swatch--image.tooltipstered.selected');
                                            if (variantSelected.length == 0) {
                                                addToCartBtn.classList.add('disabled');
                                                addToCartBtn.setAttribute("disabled", "disabled");
                                            }else{
                                                addToCartBtn.classList.remove('disabled');
                                                addToCartBtn.removeAttribute("disabled");
                                            }
                                        }
                                        jQuery(document).ready(function(){
                                            // Lấy button
                                            var addToCartBtn = document.querySelector('.single_add_to_cart_button');

                                            // Lấy select
                                            var variantSelect = document.querySelector('#product_variant_id');
                                            if(variantSelect.value) {
                                                addToCartBtn.classList.remove('disabled');
                                                addToCartBtn.removeAttribute("disabled");
                                            } else {
                                                addToCartBtn.classList.add('disabled');
                                                addToCartBtn.setAttribute("disabled", "disabled");
                                            }
                                            // Kiểm tra khi select thay đổi
                                            variantSelect.addEventListener('change', function() {
                                                if(variantSelect.value) {
                                                    addToCartBtn.classList.remove('disabled');
                                                    addToCartBtn.removeAttribute("disabled");
                                                } else {
                                                    addToCartBtn.classList.add('disabled');
                                                    addToCartBtn.setAttribute("disabled", "disabled");
                                                }
                                            });

                                        });

                                        // Plus number quantiy product detail
                                        var plusQuantity = function() {
                                            if ( jQuery('input[name="quantity"]').val() != undefined ) {
                                                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                                                if (!isNaN(currentVal)) {
                                                    jQuery('input[name="quantity"]').val(currentVal + 1);
                                                } else {
                                                    jQuery('input[name="quantity"]').val(1);
                                                }
                                            }else {
                                                console.log('error: Not see element ' + jQuery('input[name="quantity"]').val());
                                            }
                                        }
                                        // Minus number quantiy product detail
                                        var minusQuantity = function() {
                                            if ( jQuery('input[name="quantity"]').val() != undefined ) {
                                                var currentVal = parseInt(jQuery('input[name="quantity"]').val());
                                                if (!isNaN(currentVal) && currentVal > 1) {
                                                    jQuery('input[name="quantity"]').val(currentVal - 1);
                                                }
                                            }else {
                                                console.log('error: Not see element ' + jQuery('input[name="quantity"]').val());
                                            }
                                        }
                                    </script>
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                </div>
                            </div>

                        </form>


                        {{-- <div class="info-km">
                            <div class="title-km">
                                <h3>Khuyến mãi</h3>
                            </div>
                            <div class="ct-km">
                                <ul>
                                    <li>GIÁ TỐT</li>
                                    <li>Nhập mã PHUKIEN15 giảm 15% các sản phẩm phụ kiện điện tử tại Anh Phi Bán Táo
                                        (không áp dụng với các phụ kiện chính hãng Apple)</li>
                                </ul>
                            </div>
                        </div> --}}


                    </div>

{{--                    <div id="product-sidebar" class="col large-3 hide-for-medium ">--}}

{{--                        <div class="info-may">--}}
{{--                            <div class="title-may">--}}
{{--                                <h3>Thông tin máy</h3>--}}
{{--                            </div>--}}
{{--                            <div class="ct-may">--}}
{{--                                <ul>--}}
{{--                                    <li>Không hộp, giá máy không bao gồm phụ kiện từ nhà sản xuất</li>--}}
{{--                                    <li>Máy được kiểm tra hình thức và pin kỹ càng bởi kỹ thuật viên nhiều kinh--}}
{{--                                        nghiệm trước khi đến tay khách hàng</li>--}}
{{--                                    <li>Bảo hành đổi ngay máy mới trong 3 tháng nếu máy xảy ra lỗi từ nhà sản xuất--}}
{{--                                        (<a href="#" class="ct-chitiet">Xem chi tiết</a>)</li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <aside id="custom_html-4" class="widget_text widget widget_custom_html">--}}
{{--                            <div class="textwidget custom-html-widget"></div>--}}
{{--                        </aside>--}}
{{--                    </div>--}}

                </div>
            </div>

            <div class="product-footer">
                <div class="container">
                    <div class="row">
                        <div class="col large-12 div-mota">
                            <div class="woocommerce-tabs wc-tabs-wrapper">
                                <div id="tab-description">
                                    {!! $product->description !!}
                                </div>
                            </div>
{{--                            Đánh giá sản phẩm--}}
                            <div class="rating-section">
                                <h3 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">Đánh giá sản phẩm</h3>

                                <style>
                                    .comment {
                                        margin-bottom: 20px;
                                        border: 1px solid #ccc;
                                        padding: 20px;

                                        overflow-y: scroll;
                                        min-height: 100px;
                                        max-height: 500px;
                                        width: 100%;
                                    }
                                    .comment img {
                                        width: 64px;
                                        height: 64px;
                                    }
                                    .comment h5 {
                                        margin-top: 0;
                                    }
                                    /* .comment .rating {
                                        color: orange;
                                    } */
                                    .checked {
                                        color: orange;
                                    }

                                    .fb-comments {
                                        overflow-y: scroll;
                                        height: 500px;
                                        width: 100%;
                                    }

                                    .star-rating {
                                        display: flex;
                                        justify-content: center;
                                    }

                                    .star {
                                        margin-top: 10px;
                                        font-size: 20px;
                                        margin-right: 5px;
                                    }

                                    div.star.active i {
                                        color: gold;
                                    }
                                </style>
                                <div class="row large-columns-4 medium-columns-3 small-columns-2 row-small " tabindex="0">
                                    <div class="large-columns-4">
                                        @include("alerts")
                                        <form action="/review/store" method="POST">
                                            @csrf
                                            <div class="card-body">
{{--                                                <div class="star-rating">--}}
{{--                                                    <div class="star active" data-value="1"><i class="fa fa-star"></i></div>--}}
{{--                                                    <div class="star active" data-value="2"><i class="fa fa-star"></i></div>--}}
{{--                                                    <div class="star active" data-value="3"><i class="fa fa-star"></i></div>--}}
{{--                                                    <div class="star active" data-value="4"><i class="fa fa-star"></i></div>--}}
{{--                                                    <div class="star active" data-value="5"><i class="fa fa-star"></i></div>--}}
{{--                                                </div>--}}
                                                <div class="form-group">
                                                    <label>Chất lượng</label>
                                                    <div class="rating store-rating">
                                                        <span class="fa fa-star star checked" data-value="1"></span>
                                                        <span class="fa fa-star star checked" data-value="2"></span>
                                                        <span class="fa fa-star star checked" data-value="3"></span>
                                                        <span class="fa fa-star star checked" data-value="4"></span>
                                                        <span class="fa fa-star star checked" data-value="5"></span>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="rating" name="rating" value="5">
                                                <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                                <div class="form-group">
                                                    <label>Tiêu đề</label>
                                                    <input type="text" class="form-control" id="title" name="title">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nội dung</label>
                                                    <textarea rows="5" class="form-control" id="content" name="content"></textarea>
                                                </div>
                                                <button type="submit" class="button dark btn-block">Gửi đánh giá</button>
                                            </div>
                                        </form>
                                    </div>
                                    <script type="text/javascript">
                                        $('.store-rating .star').click(function() {
                                            var rating = $(this).data('value');
                                            $('input[name=rating]').val(rating);
                                            $(this).addClass('checked').prevAll('.star').addClass('checked');
                                            $(this).nextAll('.star').removeClass('checked');
                                        });

                                    </script>
                                    @if(isset($reviews) && count($reviews) > 0)
                                    <div class="large-columns-8">
                                        <div class="media comment">
                                            @foreach($reviews as $review)
                                                <div class="row">
                                                    <div class="col-sm-2" style="text-align:center">
                                                        <img src="/template/admin/images/avatar.png" class="mr-3 rounded-circle" alt="Avatar">
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <div class="media-body">
                                                            <h4 class="mt-0"><b>{{ $review->user->name }}</b></h4>
                                                            <div class="rating">
                                                                @php
                                                                    for($i = 1; $i <= 5; $i++){
                                                                        if($i <= (int)$review->rating){
                                                                            echo '<span class="fa fa-star checked"></span>';
                                                                        }else{
                                                                            echo '<span class="fa fa-star"></span>';
                                                                        }
                                                                    }
                                                                @endphp
                                                            </div>
                                                            <h6 class="mb-0"><b>{{ $review->title }}</b></h6>

                                                            <p>{{ $review->content }}</p>
                                                            <p class="mt-0 text-muted">{{ $review->created_at }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
{{--                            Sản phẩm tương tự--}}
                            <div class="related related-products-wrapper product-section">

                                <h3 class="product-section-title container-width product-section-title-related pt-half pb-half uppercase">
                                    Sản phẩm tương tự </h3>




                                <div class="row large-columns-4 medium-columns-3 small-columns-2 row-small slider row-slider slider-nav-reveal slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : false}'>

                                    @foreach($related_products as $related_product)
                                    <div class="product-small col has-hover product type-product post-5006 status-publish first instock product_cat-ipad-no-box product_cat-tablet has-post-thumbnail sale shipping-taxable purchasable product-type-variable">
                                        <div class="col-inner">

                                            @if($product->maxDiscountPercentage() > 0)
                                                <div class="badge-container absolute left top z-1">
                                                    <div class="callout badge badge-circle">
                                                        <div class="badge-inner secondary on-sale"><span class="onsale">-{{$product->maxDiscountPercentage()}}%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="product-small box ">
                                                <div class="box-image">
                                                    <div class="image-none">
                                                        <a href="/product/{{ $related_product->slug }}" aria-label="{{ $related_product->name }}">
                                                            <img width="300" height="300" src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20300%20300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" data-src="{{ $related_product->image }}" class="lazy-load attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy" /> </a>
                                                    </div>
                                                    <div class="image-tools is-small top right show-on-hover">
                                                        <a href="/product/{{ $related_product->slug }}">

                                                        </a>
                                                    </div>
                                                    <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                    </div>
                                                    <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                    </div>
                                                    @if(!$related_product->hasStock())
                                                        <div class="out-of-stock-label">Hết hàng</div>
                                                    @endif
                                                </div>

                                                <div class="box-text box-text-products">
                                                    <div class="title-wrapper">
                                                        <p class="name product-title woocommerce-loop-product__title">
                                                            <a href="/product/{{ $related_product->slug }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">{{ $related_product->name }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="price-wrapper">
                                                        <span class="price">
                                                            <ins class="show-price-min">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    @if ($related_product->variants()->count() > 0)
                                                                        <bdi>{{ number_format($related_product->variants()->min('price')) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi>
                                                                    @else
                                                                        <bdi><del>0<span class="woocommerce-Price-currencySymbol">&#8363;</span></del></bdi>
                                                                    @endif
                                                                </span>
                                                            </ins>
                                                        </span>
{{--                                                        <span class="price"><span class="woocommerce-Price-amount amount"><bdi>18,000,000<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></span>--}}
                                                    </div>
                                                    <div class="box-name__box-raiting">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
