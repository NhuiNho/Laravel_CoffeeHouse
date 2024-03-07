<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- link đăng nhập -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage\frontend\assets\css\app.css') }}">
    <!-- end link đăng nhập -->
    <title>@yield('title')</title>
    <style>

    </style>
</head>

<body>
    <div class="alert_normal">
        @include('backend.layouts.alerts')
    </div>

    @include('frontend.layouts.header')

    <div class="container pt-5 mt-5">
        <div class="row">
            @yield('content')
        </div>
    </div>

    {{-- footer --}}
</body>

</html>
