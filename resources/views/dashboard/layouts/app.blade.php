<!DOCTYPE html>
<html lang="en">

@include('dashboard.layouts.partials.header')

<body class="with-welcome-text">

<div class="container-scroller">

    @include('dashboard.layouts.partials.topNav')

    <div class="container-fluid page-body-wrapper">

        @include('dashboard.layouts.partials.sideNav')

        <div class="main-panel">
            <div class="content-wrapper">

                @yield('content')

            </div>

            @include('dashboard.layouts.partials.footer')
        </div>

    </div>
</div>

<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>

<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/settings.js') }}"></script>

@stack('scripts')

</body>
</html>