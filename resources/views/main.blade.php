<!DOCTYPE html>
<html dir="ltr" lang="vi" class="loading-site no-js">
<head>
    @include('head')
</head>

<body class="@yield('bodyClass')">
    <div id="wrapper">
        @include('navbar')
        @if(isset($include_breadcrumbs) && $include_breadcrumbs)
          @include('breadcrumbs')
        @endif
        <main id="main" class="" style="min-height: 520px;">
            @include('contact-button')
            @yield('content')
        </main>
        @include('foot')
    </div>
    @include('mobile-menu')
</body>
</html>
