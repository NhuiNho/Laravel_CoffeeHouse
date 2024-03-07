<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('storage/backend/assets/img/login_admin.jpg') }}">
    <!-- link đăng nhập -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/frontend/assets/css/app.css') }}">
    <!-- end link đăng nhập -->
    <title>@yield('title')</title>
    <style>

    </style>
</head>

<body>
    @include('frontend.layouts.header')

    <div class="alert_normal">
        @include('backend.layouts.alerts')
    </div>

    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>

    {{-- footer --}}

    <!-- Di chuyển Bootstrap JavaScript xuống cuối trang -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Trong phần head của view -->
    @if (isset($openInNewTab) && $openInNewTab)
        <script>
            window.onload = function() {
                // Mở trang trong tab mới
                window.open('', '_blank');
            }
        </script>
    @endif

</body>

</html>
