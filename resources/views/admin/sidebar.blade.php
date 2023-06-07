    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="/" class="brand-link text-center">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="/template/admin/images/avatar.png" class="img-circle
                    elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        {{ Auth::user()-> email }}
                    </a>
                    <span class="badge bg-danger">
                        Admin
                    </span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Thống kê</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/user/list" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Người dùng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/order/list" class="nav-link">
                            <i class="nav-icon fas fa-sticky-note"></i>
                            <p>Đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/review/list" class="nav-link">
                            <i class="nav-icon fas fa-star"></i>
                            <p>Đánh giá</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/category/add" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm danh mục</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/category/list" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List danh mục</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Sản phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/product/add" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thêm sản phẩm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/product/list" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>List sản phẩm</p>
                            </a>
                        </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/account/logout" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Đăng xuất</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
