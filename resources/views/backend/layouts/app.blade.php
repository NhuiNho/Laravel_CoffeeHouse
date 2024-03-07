<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('storage\backend\assets\img\login_admin.jpg') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css"
        href="{{ asset('storage\backend\assets\lib\perfect-scrollbar\css\perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('storage\backend\assets\lib\material-design-icons\css\material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('storage\backend\assets\lib\jquery.vectormap\jquery-jvectormap-1.2.2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('storage\backend\assets\lib\jqvmap\jqvmap.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('storage\backend\assets\lib\datetimepicker\css\bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage\backend\assets\css\app.css') }}" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <div class="be-wrapper be-fixed-sidebar">
        @include('backend.layouts.alerts')

        @if (session()->has('admin_id'))
            @include('backend.layouts.header1')
        @endif


        @yield('content')


        @if (session()->has('admin_id'))
            @include('backend.layouts.header2')
        @endif
    </div>

    <script src="{{ asset('storage\backend\assets\lib\jquery\jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\perfect-scrollbar\js\perfect-scrollbar.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\bootstrap\dist\js\bootstrap.bundle.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\js\app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\jquery.flot.pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\jquery.flot.time.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\jquery.flot.resize.j') }}"" type=" text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\plugins\jquery.flot.orderBars.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\plugins\curvedLines.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-flot\plugins\jquery.flot.tooltip.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery.sparkline\jquery.sparkline.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\countup\countUp.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jquery-ui\jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jqvmap\jquery.vmap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('storage\backend\assets\lib\jqvmap\maps\jquery.vmap.world.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            //-initialize the javascript
            App.init();
            App.dashboard();

        });
    </script>
</body>

</html>
