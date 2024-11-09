<!doctype html>
<html>
    @include('components.head')

    <body>
        <div>
            @include('components.header')

            <div id="main" class="max-w-screen-xl m-auto">
                @yield('content')
            </div>

            @include('components.footer')
        </div>
    </body>
</html>
