<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.head')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('admin.navbar')
        @include('admin.sidebar')
        
        <div class="content-wrapper">
            <section class="content" style="margin-top: 15px">
                <div class="container-fluid">
                    @include('admin.alerts')
                    @yield('content')
                </div>
            </section>
        </div>
        
        @include('admin.foot')

    </div>
</body>
</html>