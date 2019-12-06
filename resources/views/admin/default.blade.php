<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('app_name') }}</title>

    <meta name="description" content="{{ setting('app_desc') }}">
    <meta name="author" content="@egy.js">

    <!-- Styles -->
	<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
	{{-- <link href="{{ mix('/css/rtl.css') }}" rel="stylesheet">  --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ setting('app_logo') }}">

    <style>
        .tr-trashed{
            background: rgba(255, 94, 0, 0.32) !important;
        }
    </style>
	@yield('css')
	@stack('css')

</head>

<body class="app">

    @include('admin.partials.spinner')

    <div>
        <!-- #Left Sidebar ==================== -->
        @include('admin.partials.sidebar')

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('admin.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">

                        <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>

						@include('admin.partials.messages')
						@yield('content')

                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © 2017 Designed by
                    <a href="https://colorlib.com" target='_blank' title="Colorlib">Colorlib</a>. All rights reserved.</span>
            </footer>
        </div>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>

    @yield('js')
    @stack('js')

</body>

</html>
