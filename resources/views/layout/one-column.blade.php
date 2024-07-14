<!doctype html>
<html>
    @include('components.head')

    <body class="text-white">
        <div>
            @include('components.header')

            <div id="main" class="row">
                @yield('content')
            </div>

            @include('components.footer')
        </div>
    </body>
</html>
