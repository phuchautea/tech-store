<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.head')

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><b>PH</b>Cake</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Đăng nhập hệ thống</p>

                @include('admin.alerts')

                <form action="/admin/users/login/store" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Địa chỉ email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">
                                    Ghi nhớ
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="forgot-password.php">Quên mật khẩu?</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Tạo tài khoản</a>
                </p>
            </div>
        </div>
    </div>

    <script src="/template/admin/plugins/jquery/jquery.min.js"></script>
    <script src="/template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/template/admin/dist/js/adminlte.min.js"></script>

</body>

</html>