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
    </style>
    <div id="content" class="content-area page-wrapper" role="main">
        <div class="row row-main">
            <div class="large-12 col">
                <div class="col-inner">
                    <div class="page-layout">
                        <div class="wrapper-row pd-page">
                            <div class="container-fluid">
                                <h1 style="color:red; text-align:center">ĐĂNG NHẬP</h1>
                                <div class="col-md-6 col-xs-12 wrapbox-content-account">
                                    <div id="customer-login">
                                        <div id="login" class="userbox">
                                            <div class="accounttype">
                                                <h2 class="title"></h2>
                                            </div>
                                            <form accept-charset="UTF-8" action="/account/login" id="customer_login" method="post">
                                                @csrf
                                                @include('alerts')
                                                <div class="clearfix large_form">
                                                    <input autofocus required="" type="email" value="" name="email" id="email" placeholder="Email" class="text">
                                                </div>

                                                <div class="clearfix large_form  large_form-mr10">
                                                    <input required="" type="password" value="" name="password" id="password" placeholder="Mật khẩu" class="text" size="16">
                                                </div>
                                                <div class="clearfix action_account_custommer">
                                                    <div class="action_bottom dark">
                                                        <input style="width:100%" class="btn btn-signin" type="submit" value="Đăng nhập">
                                                    </div>
                                                    <div class="req_pass">
                                                        <a href="#" onclick="showRecoverPasswordForm();return false;"><b>Quên mật khẩu?</b></a>
                                                        hoặc <a href="/account/register" title="Đăng ký"><b>Tạo tài khoản</b></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="recover-password" style="display:none;" class="userbox">
                                            <div class="accounttype">
                                                <h2>Phục hồi mật khẩu</h2>
                                            </div>
                                            <form accept-charset="UTF-8" action="/account/recover" method="post">
                                                <input name="form_type" type="hidden" value="recover_customer_password">
                                                <input name="utf8" type="hidden" value="✓">


                                                <div class="clearfix large_form large_form-mr10">
                                                    <label for="email" class="icon-field"><i class="icon-login icon-envelope "></i></label>
                                                    <input type="email" value="" size="30" name="email" placeholder="Email" id="recover-email" class="text">
                                                </div>
                                                <div class="clearfix action_account_custommer">
                                                    <div class="action_bottom button dark">
                                                        <input class="btn" type="submit" value="Gửi">
                                                    </div>
                                                    <div class="req_pass">
                                                        <a href="#" onclick="hideRecoverPasswordForm();return false;">Hủy</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
