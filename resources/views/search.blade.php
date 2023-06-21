@extends('main')
@section('bodyClass', 'product-template-default single single-product postid-3270 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
    <style>
        .container-fluid {
            display: flex;
            flex-direction: column;
            height: 85vh;
        }
    </style>
    <div id="content" class="content-area page-wrapper" role="main">
        <div class="row row-main">
            <div class="col small-12 large-12">
                <div class="col-inner">
                    <div class="page-layout">
                        <div class="wrapper-row pd-page">
                            <div class="">
                                <div class="heading-page">
                                    <div class="header-page">
                                        <h1>Tìm kiếm</h1>
                                        <p class="subtxt">Có <span>{{ $products->count() }} sản phẩm</span> cho tìm kiếm</p>
                                    </div>
                                </div>
                                <p class="subtext-result"> Kết quả tìm kiếm cho <strong>'{{ $query }}'</strong>. </p>
                                @if($products->count() > 0)
                                    <div class="row category-page-row">
                                        <div class="col large-12">
                                            <div class="shop-container">
                                                <div class="woocommerce-notices-wrapper"></div>
                                                <div class="products row row-small large-columns-4 medium-columns-3 small-columns-2">
                                                    @foreach ($products as $product)
                                                    <div class="product-small col has-hover product type-product post-3252 status-publish first instock product_cat-apple product_cat-dien-thoai product_cat-iphone-11-series product_tag-apple product_tag-chinh-hang product_tag-dien-thoai product_tag-gia-re product_tag-ipad product_tag-ipad-air product_tag-ipad-gen product_tag-ipad-mini product_tag-ipad-pro product_tag-iphone product_tag-laptop product_tag-macbook product_tag-macbook-air product_tag-macbook-pro product_tag-may-tinh-bang product_tag-uy-tin has-post-thumbnail sale shipping-taxable purchasable product-type-variable">
                                                        <div class="col-inner">
                                                            <div class="product-small box">
                                                                <div class="box-image">
                                                                    <div class="image-none">
                                                                        <a href="/product/{{ $product->slug }}" aria-label="{{ $product->name }}">
                                                                            <img width="300" height="300" src="{{ $product->image }}" data-src="{{ $product->image }}" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail lazy-load-active" alt="" decoding="async" loading="lazy"> </a>
                                                                    </div>
                                                                    <div class="image-tools is-small top right show-on-hover">
                                                                        <a href="/product/{{ $product->slug }}"></a>
                                                                    </div>
                                                                    <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                                    </div>
                                                                    <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                                    </div>
                                                                </div>

                                                                <div class="box-text box-text-products">
                                                                    <div class="title-wrapper">
                                                                        <p class="name product-title woocommerce-loop-product__title">
                                                                            <a href="/product/{{ $product->slug }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
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
                                                </div>
                                                <div class="container">
                                                    <nav class="woocommerce-pagination">
                                                        {{ $products->links('custom_pagination') }}
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <h3 style="color:red; text-align:center">Không tìm thấy sản phẩm nào phù hợp</h3>
                                    <h4 style="text-align:center;"><a href="/">Trở về trang chủ</a></h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('form.search-page').submit(function (e) {
            e.preventDefault();
            var q = $(this).find('input[type="text"]').val();
            if (q.indexOf('script') > -1 || q.indexOf('>') > -1) {
                alert("Key word của bạn có chứa mã độc hại");
                $(this).find('input[type="text"]').val('');
            }
            else {
                window.location.href = "/search?type=product&q=" + $('input.search_box').val();
            }
        })
    </script>
@endsection
