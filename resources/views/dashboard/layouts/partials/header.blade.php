<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name', 'Admin Panel') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/select.dataTables.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @php
        $dashboardSiteLogo = \App\Models\Setting::where('key', 'site_logo')->value('value');
    @endphp
    <link rel="shortcut icon" href="{{ $dashboardSiteLogo ? asset($dashboardSiteLogo) : asset('frontend-assets/imgs/logo/logo2.png') }}" />

    <style>
        .form-select, select {
            color: #000000 !important;
            background-color: #ffffff !important;
            border: 1px solid #dee2e6 !important;
        }
        /* Ensure dropdown arrow is visible in Bootstrap selects */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 0.75rem center !important;
            background-size: 16px 12px !important;
            padding-right: 2.25rem !important;
        }

        /* Theme Overrides */
        :root {
            --primary-pink: #EE2D7A;
            --primary-pink-hover: #d12469;
        }

        .sidebar .nav .nav-item.active > .nav-link {
            background: var(--primary-pink) !important;
        }
        .sidebar .nav.sub-menu .nav-item .nav-link.active {
            color: var(--primary-pink) !important;
        }
        .sidebar .nav.sub-menu .nav-item .nav-link:before {
            border-color: var(--primary-pink) !important;
        }
        
        .btn-primary, .btn-info, .badge-primary, .badge-info {
            background-color: var(--primary-pink) !important;
            border-color: var(--primary-pink) !important;
            color: #fff !important;
        }
        .btn-outline-primary {
            color: var(--primary-pink) !important;
            border-color: var(--primary-pink) !important;
        }
        .btn-outline-primary:hover {
            background-color: var(--primary-pink) !important;
            color: #fff !important;
        }

        .text-primary, .text-info {
            color: var(--primary-pink) !important;
        }

        .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .count-indicator .count {
            background: var(--primary-pink) !important;
        }

        .dropdown-item i.text-primary {
            color: var(--primary-pink) !important;
        }

        .page-link {
            color: var(--primary-pink) !important;
        }
        .page-item.active .page-link {
            background-color: var(--primary-pink) !important;
            border-color: var(--primary-pink) !important;
        }

        .progress .progress-bar {
            background-color: var(--primary-pink) !important;
        }

        .nav-tabs .nav-link.active {
            border-bottom: 2px solid var(--primary-pink) !important;
            color: var(--primary-pink) !important;
        }
    </style>

    {{-- Extra page CSS --}}
    @stack('styles')
</head>