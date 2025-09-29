<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>ESCALAFÓN | ADMINPANEL</title>

    <meta name="description" content="">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


     <!-- tus estilos y meta tags -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <!-- jQuery primero -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <style>
        /* Color fijo en el botón del accordion */
        .accordion-button {
            background-color: #eef4ff !important; /* Color fijo */
            color: #000 !important; /* Texto negro */
        }

        /* Evitar que cambie al abrir/cerrar */
        .accordion-button:not(.collapsed) {
            background-color: #eef4ff !important;
            color: #000 !important;
            box-shadow: none !important;
        }

        /* Quitar el hover gris default de Bootstrap */
        .accordion-button:hover {
            background-color: #eef4ff !important;
            color: #000 !important;
        }
    </style>


    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/sass/dashmix/themes/_base.scss', 'resources/js/dashmix/app.js'])
    @yield('js')
</head>

<body>
    <div id="page-container"
        class="sidebar-o enable-page-overlay sidebar-mini page-header-dark light-mode side-scroll page-header-fixed">
        @include('layouts.common.sidebar')
        @include('layouts.common.header')

        <main id="main-container">
            @yield('content')
        </main>

        <footer id="page-footer" class="bg-body-light">
            <div class="content py-0">
                <div class="row fs-sm">
                    <div class="col-sm-6 order-sm-1 text-center text-sm-start">
                        <a class="fw-semibold" href="#" target="_blank">ESCALAFÓN</a> &copy;
                        <span data-toggle="year-copy"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @stack('scripts')
</body>

</html>
