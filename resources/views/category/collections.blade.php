@php
$include_breadcrumbs = true;
@endphp
@extends('main')
@section('bodyClass', 'archive tax-product_cat term-dien-thoai term-16 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
<div class="row category-page-row">
    <div class="col large-12">
        <div class="shop-container">
            <div class="flex-col medium-text-center">
                <p class="woocommerce-result-count hide-for-medium">Lọc sản phẩm</p>
                <form class="woocommerce-ordering" method="get" action="/">
                    <select name="sortby" class="sortby" aria-label="sortby">
                        <option value="manual">Sản phẩm nổi bật</option>
                        <option value="price-ascending">Giá: Tăng dần</option>
                        <option value="price-descending">Giá: Giảm dần</option>
                        <option value="name-ascending">Tên: A-Z</option>
                        <option value="name-descending">Tên: Z-A</option>
                        <option value="created-ascending">Cũ nhất</option>
                        <option value="created-descending">Mới nhất</option>
                        <option value="best-selling">Bán chạy nhất</option>
                    </select>
                </form>
            </div>
            <div class="woocommerce-notices-wrapper"></div>
            <div class="products row row-small large-columns-4 medium-columns-3 small-columns-2">
                @foreach ($products as $product)
                <div class="product-small col has-hover product type-product post-3252 status-publish first instock product_cat-apple product_cat-dien-thoai product_cat-iphone-11-series product_tag-apple product_tag-chinh-hang product_tag-dien-thoai product_tag-gia-re product_tag-ipad product_tag-ipad-air product_tag-ipad-gen product_tag-ipad-mini product_tag-ipad-pro product_tag-iphone product_tag-laptop product_tag-macbook product_tag-macbook-air product_tag-macbook-pro product_tag-may-tinh-bang product_tag-uy-tin has-post-thumbnail sale shipping-taxable purchasable product-type-variable">
                    <div class="col-inner">
                        @if($product->maxDiscountPercentage() > 0)
                            <div class="badge-container absolute left top z-1">
                                <div class="callout badge badge-circle">
                                    <div class="badge-inner secondary on-sale"><span class="onsale">-{{$product->maxDiscountPercentage()}}%</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="product-small box">
                            <div class="box-image">
                                <div class="image-none">
                                    <a href="/product/{{ $product->slug }}/" aria-label="{{ $product->name }}">
                                        <img width="300" height="300" src="data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%20300%20300%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3C%2Fsvg%3E" data-src="{{ $product->image }}" class="lazy-load attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" loading="lazy" /> </a>
                                </div>
                                <div class="image-tools is-small top right show-on-hover">
                                    <a href="/product/{{ $product->slug }}/"></a>
                                </div>
                                <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                </div>
                                <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                </div>
                                @if(!$product->hasStock())
                                <div class="out-of-stock-label">Hết hàng</div>
                                @endif
                            </div>

                            <div class="box-text box-text-products">
                                <div class="title-wrapper">
                                    <p class="name product-title woocommerce-loop-product__title">
                                        <a href="/product/{{ $product->slug }}/" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            {{ $product->name }}
                                        </a>
                                    </p>
                                </div>

                                <div class="price-wrapper">
                                    <span class="price">
                                        <ins class="show-price-min">
                                            <span class="woocommerce-Price-amount amount">
                                                @if ($product->variants()->count() > 0)
                                                    <bdi>{{ number_format($product->variants()->min('price')) }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi>
                                                @else
                                                    <bdi><del>0<span class="woocommerce-Price-currencySymbol">&#8363;</span></del></bdi>
                                                @endif
                                            </span>
                                        </ins>
                                    </span>
                                </div>
                                <div class="box-name__box-raiting">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div><!-- row -->
        </div><!-- shop container -->
    </div>
</div>
    <script type="text/javascript">

        $(document).ready(function() {
            var urlParams = new URLSearchParams(window.location.search);
            var sortByValue = urlParams.get('sortby');
            var pageValue = urlParams.get('page');
            if (sortByValue) {
                $('.sortby').val(sortByValue);
            }
            $('.sortby').on('change', function() {
                var sortByValue = $(this).val();
                var currentUrl = window.location.href.split('?')[0];
                var newUrl = currentUrl + '?sortby=' + sortByValue;
                if (pageValue) {
                    newUrl += '&page=' + pageValue;
                }
                window.location.href = newUrl;
            });
        });

    </script>
@endsection
