<!-- Mobile menu -->
<div id="main-menu" class="mobile-sidebar no-scrollbar mfp-hide">
    <div class="sidebar-menu no-scrollbar ">
        <ul class="nav nav-sidebar nav-vertical nav-uppercase">
            <li class="html custom html_nav_position_text">
                <div class="logo-mobile-nav">
                    <img src="/template/user/images/logo.png" />
                </div>
            </li>
            @if(isset($categoryMenus))
                @foreach($categoryMenus as $category)
                <li class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-30">
                    <a href="/collections/{{ $category->slug }}/">{{ $category->name }}</a>
                </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
<style>
    .single-product div#tab-description {
        overflow: hidden;
        position: relative;
        padding-bottom: 50px;
    }

    .single-product .tab-panels div#tab-description.panel:not(.active) {
        height: 0 !important;
    }

    .itcodewp_readmore_flatsome {
        text-align: center;
        cursor: pointer;
        position: absolute;
        z-index: 10;
        bottom: -1px;
        width: 100%;
        background: #fff;
        height: 50px;
    }

    .itcodewp_readmore_flatsome:before {
        height: 45px;
        margin-top: -45px;
        content: "";
        background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
        display: block;
    }

    .itcodewp_readmore_flatsome a {
        color: #484545;
        /* display: block; */
        background-color: #ffffff;
        padding: 8px 70px;
        width: 200px;
        margin: auto;
        border-radius: 6px;
        box-shadow: rgb(60 64 67 / 10%) 0px 1px 2px 0px, rgb(60 64 67 / 15%) 0px 2px 6px 2px;
    }

    .itcodewp_readmore_flatsome a:after {
        content: '';
        width: 0;
        right: 0;
        border-top: 6px solid #484545;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        display: inline-block;
        vertical-align: middle;
        margin: -2px 0 0 5px;
    }

    .itcodewp_readmore_flatsome_less a:after {
        border-top: 0;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-bottom: 6px solid #fff;
    }

    .itcodewp_readmore_flatsome_less:before {
        display: none;
    }

    .itcodewp_readmore_flatsome_less a:after {
        content: '';
        width: 0;
        right: 0;
        border-bottom: 6px solid #484545;
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        display: inline-block;
        vertical-align: middle;
        margin: -2px 0 0 5px;
    }

    .itcodewp_readmore_flatsome:hover a {
        background: #FEF2F2;
        border: 1px solid #D70018;
        color: #D70018;
    }

    .itcodewp_readmore_flatsome_less:hover a:after {
        border-bottom: 6px solid #D70018;
    }

    .itcodewp_readmore_flatsome_more:hover a:after {
        border-top: 6px solid #D70018;
    }
</style>
