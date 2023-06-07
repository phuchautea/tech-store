<header id="header" class="header has-sticky sticky-jump">
    <div class="header-wrapper">
        <div id="masthead" class="header-main show-logo-center">
            <div class="header-inner flex-row container logo-center medium-logo-center" role="navigation">
                <!-- Logo -->
                <div id="logo" class="flex-col logo">
                    <!-- Header logo -->
                    <a href="/" title="TechStore - Máy tính bảng, điện thoại, laptop, phụ kiện chính hãng" rel="home">
                        <img width="212" height="55" src="/template/user/images/logo.png" class="header_logo header-logo"
                            alt="TechStore" />
                    </a>
                </div>
                <!-- Mobile Left Elements -->
                <div class="flex-col show-for-medium flex-left">
                    <ul class="mobile-nav nav nav-left ">
                        <li class="nav-icon has-icon">
                            <div class="header-button"> <a href="#" data-open="#main-menu" data-pos="left"
                                    data-bg="main-menu-overlay" data-color=""
                                    class="icon button round is-outline is-small" aria-label="Menu"
                                    aria-controls="main-menu" aria-expanded="false">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Left Elements -->
{{--                <div class="flex-col hide-for-medium flex-left">--}}
{{--                    <ul class="header-nav header-nav-main nav nav-left  nav-uppercase">--}}
{{--                        <div id="mega-menu-wrap" class="ot-vm-hover">--}}
{{--                            <div id="mega-menu-title">--}}
{{--                                <i class="fa fa-bars"></i>--}}
{{--                            </div>--}}
{{--                            <ul id="mega_menu" class="sf-menu sf-vertical">--}}
{{--                                @if(isset($categories))--}}
{{--                                    @foreach($categories as $category)--}}
{{--                                        <li id="menu-item-30"--}}
{{--                                            class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-30">--}}
{{--                                            <a href="/collections/{{ $category->slug }}">{{ $category->name }}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </ul>--}}
{{--                </div>--}}
                <!-- Right Elements -->
                <div class="flex-col hide-for-medium flex-right">
                    <ul class="header-nav header-nav-main nav nav-right  nav-uppercase">
                        <li class="header-search-form search-form html relative has-icon">
                            <div class="header-search-form-wrapper">
                                <div class="searchform-wrapper ux-search-box relative form-flat is-normal">
                                    <form role="search" method="get" class="searchform" action="/search">
                                        <div class="flex-row relative">
                                            <div class="flex-col flex-grow">
                                                <label class="screen-reader-text"
                                                    for="woocommerce-product-search-field-0">Tìm kiếm:</label>
                                                <input type="search" id="woocommerce-product-search-field-0"
                                                    class="search-field mb-0" placeholder="Tìm kiếm&hellip;" value=""
                                                    name="q" />
                                                <input type="hidden" name="type" value="product" />
                                            </div>
                                            <div class="flex-col">
                                                <button type="submit" value="Tìm kiếm"
                                                    class="ux-search-submit submit-button secondary button icon mb-0"
                                                    aria-label="Submit">
                                                    <i class="fa fa-search"></i> </button>
                                            </div>
                                        </div>
                                        <div class="live-search-results text-left z-top"></div>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <li class="html custom html_topbar_right"><a class="item-about about-1 about-contact"
                                href="tel:0378021211">
                                <div class="about__box-icon"><svg xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 30.83 30.94" width="24" height="24">
                                        <g id="Layer_2" data-name="Layer 2">
                                            <g id="Layer_1-2" data-name="Layer 1">
                                                <path class="cls-1"
                                                    d="M6.78,20.27a31,31,0,0,0,10.29,8.06A15.91,15.91,0,0,0,22.82,30h.41a4.77,4.77,0,0,0,3.7-1.59,0,0,0,0,0,0,0,14.62,14.62,0,0,1,1.17-1.2c.28-.28.57-.56.85-.85A2.91,2.91,0,0,0,29,22L25.33,18.4a2.94,2.94,0,0,0-2.13-1,3.07,3.07,0,0,0-2.15,1l-2.16,2.17c-.2-.12-.4-.22-.6-.32a6.74,6.74,0,0,1-.66-.36,22.82,22.82,0,0,1-5.47-5A13.11,13.11,0,0,1,10.32,12c.56-.52,1.09-1.05,1.61-1.58l.55-.56a3.07,3.07,0,0,0,1-2.17,3.08,3.08,0,0,0-1-2.18l-1.8-1.8L10.07,3c-.4-.41-.82-.83-1.23-1.21A3,3,0,0,0,6.72.9a3.07,3.07,0,0,0-2.15.94L2.31,4.09a4.64,4.64,0,0,0-1.38,3,11.09,11.09,0,0,0,.84,4.83,28.11,28.11,0,0,0,5,8.37Z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div class="about__box-content">
                                    <p class="mb-0 title" style="color:#263B78;">Gọi mua
                                        hàng<br><strong>08.7722.0202</strong></p>
                                </div>
                            </a></li>
{{--                        <li class="html custom html_top_right_text"><a class="item-about about-2 about-store"--}}
{{--                                href="/cua-hang">--}}
{{--                                <div class="about__box-icon"><svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                        viewBox="0 0 23.22 30.36" width="25" height="25">--}}
{{--                                        <g id="Layer_2" data-name="Layer 2">--}}
{{--                                            <g id="Layer_1-2" data-name="Layer 1">--}}
{{--                                                <path class="cls-1"--}}
{{--                                                    d="M11.61.9A10.77,10.77,0,0,0,.9,11.69C.9,20.14,10.6,28.87,11,29.23a.87.87,0,0,0,1.18,0c.42-.36,10.12-9.09,10.12-17.54A10.77,10.77,0,0,0,11.61.9Z">--}}
{{--                                                </path>--}}
{{--                                                <path class="cls-1"--}}
{{--                                                    d="M11.61,16.35a4.74,4.74,0,1,1,4.74-4.74,4.75,4.75,0,0,1-4.74,4.74Z">--}}
{{--                                                </path>--}}
{{--                                            </g>--}}
{{--                                        </g>--}}
{{--                                    </svg></div>--}}
{{--                                <div class="about__box-content">--}}
{{--                                    <p class="mb-0 title" style="color:#263B78;">Cửa hàng</p>--}}
{{--                                </div>--}}
{{--                            </a></li>--}}
                        <li class="cart-item has-icon">
                            <div class="header-button">
                                <a href="/account/" title="Giỏ hàng" class="header-cart-link icon button round is-outline is-small">
                                    <i class="icon-user" style="color: #263B78;"></i>
                                </a>
                            </div>
                        </li>
                        <li class="cart-item has-icon">
                            <div class="header-button">
                                <a href="/carts/" title="Giỏ hàng"
                                    class="header-cart-link icon button round is-outline is-small">
                                    <i class="icon-shopping-bag" data-icon-label="{{ $totalItemCartMenus }}"></i>
                                </a>
                            </div>

                        </li>
                    </ul>
                </div>
                <!-- Mobile Right Elements -->
                <div class="flex-col show-for-medium flex-right">
                    <ul class="mobile-nav nav nav-right ">
                        <li class="cart-item has-icon">
                            <div class="header-button"> <a href="/carts/" title="Giỏ hàng"
                                    class="header-cart-link icon button round is-outline is-small">

                                    <i class="icon-shopping-bag" data-icon-label="{{ $totalItemCartMenus }}">
                                    </i>
                                </a>
                            </div>
                        </li>
                        <li class="header-search header-search-lightbox has-icon">
                            <div class="header-button"> <a href="#search-lightbox" aria-label="Tìm kiếm"
                                    data-open="#search-lightbox" data-focus="input.search-field"
                                    class="icon button round is-outline is-small">
                                    <i class="icon-search" style="font-size:16px;"></i></a>
                            </div>
                            <div id="search-lightbox" class="mfp-hide dark text-center">
                                <div class="searchform-wrapper ux-search-box relative form-flat is-large">
                                    <form role="search" method="get" class="searchform" action="/search">
                                        <div class="flex-row relative">
                                            <div class="flex-col flex-grow">
                                                <label class="screen-reader-text"
                                                    for="woocommerce-product-search-field-1">Tìm kiếm:</label>
                                                <input type="search" id="woocommerce-product-search-field-1"
                                                    class="search-field mb-0" placeholder="Tìm kiếm&hellip;" value=""
                                                    name="q" />
                                                <input type="hidden" name="post_type" value="product" />
                                            </div>
                                            <div class="flex-col">
                                                <button type="submit" value="Tìm kiếm"
                                                    class="ux-search-submit submit-button secondary button icon mb-0"
                                                    aria-label="Submit">
                                                    <i class="icon-search"></i> </button>
                                            </div>
                                        </div>
                                        <div class="live-search-results text-left z-top"></div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="top-divider full-width"></div>
            </div>
        </div>
        <div class="header-bg-container fill">
            <div class="header-bg-image fill"></div>
            <div class="header-bg-color fill"></div>
        </div>
    </div>
</header>
