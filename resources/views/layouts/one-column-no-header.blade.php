<!doctype html>
<html>
    <x-head/>

    <body>
        <livewire:notification.notification />

        <div id="main" class="max-w-screen-xl m-auto">
            @if(isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </div>

        @livewireScriptConfig

        @stack('scripts')
    </body>
</html>
