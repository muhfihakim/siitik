<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head')
    @yield('css')
</head>

<body>
    <header class="sticky-top">
    </header>
    <main class="content container mx-auto">
        @yield('content')
    </main>
    @include('admin.layouts.footer')
</body>
@yield('scripts')
<script disable-devtool-auto src='{{ asset('admin/assets/js/protected.js') }}'></script>

</html>
