<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="{{ asset('img/general/CompanyLogo.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>@yield('title') | LEAVE MANAGEMENT</title>
</head>

<body>
    @yield('content')

    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
