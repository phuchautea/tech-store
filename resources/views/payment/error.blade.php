@extends('main')
@section('bodyClass', 'product-template-default single single-product postid-3270 theme-flatsome ot-vertical-menu ot-menu-show-home woocommerce woocommerce-page woocommerce-no-js lightbox nav-dropdown-has-arrow nav-dropdown-has-shadow nav-dropdown-has-border')
@section('content')
    <style>
        .container-fluid {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 85vh;
        }
        .error-icon {
            width: 80px;
            height: 115px;
            position: relative;
            margin: 50px auto;
        }

        .error-icon:before,
        .error-icon:after {
            content: "";
            position: absolute;
            width: 5px;
            height: 20px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f00;
        }

        .error-icon:before {
            transform: rotate(45deg);
        }

        .error-icon:after {
            transform: rotate(-45deg);
        }

        .error-icon:before,
        .error-icon:after {
            animation: lineAnim 1s ease forwards;
        }
        @keyframes lineAnim {
            0% {
                height: 0;
            }

            100% {
                height: 50px;
            }
        }
    </style>
    <div id="content" class="content-area page-wrapper" role="main">
        <div class="row row-main">
            <div class="large-12 col">
                <div class="col-inner">
                    <div class="page-layout">
                        <div class="wrapper-row pd-page">
                            <div class="container-fluid">
                                <div class="error-icon"></div>
                                <h3 style="color:red; text-align:center">THANH TOÁN KHÔNG THÀNH CÔNG</h3>
                                <h3 style="text-align:center;">Trở lại giỏ hàng <a style="color:green" href="/carts/">tại đây</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
