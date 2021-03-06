<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    @include('includes.style')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    @include('includes.navbar')
    
    @yield('content')

    @include('includes.footer')

    @include('includes.script')

    @stack('addon-script')
</body>

</html>