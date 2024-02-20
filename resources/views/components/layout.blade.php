<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>RoyalUI Admin</title>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
        <link rel="stylesheet" href="{{ asset('/vendors/ti-icons/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/base/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="shortcut icon" href="images/favicon.png" />
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    <body>
        <div class="container-scroller">

            <x-navbar />

            <div class="container-fluid page-body-wrapper">
                <x-sidebar />

                {{$slot}}
            </div>
        </div>


        <script src="{{ asset('/vendors/base/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/off-canvas.js') }}"></script>
        <script src="{{ asset('/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('/js/template.js') }}"></script>
        <script src="{{ asset('/js/todolist.js') }}"></script>
        <script src="{{ asset('/js/dashboard.js') }}"></script>
        {{-- <script src="{{ asset('/js/chart.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}


    </body>

</html>