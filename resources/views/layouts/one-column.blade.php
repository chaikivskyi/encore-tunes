<!doctype html>
<html>
    <x-head/>

    <body>
        <div>
            <livewire:notification.notification />
            <x-header />

            <div id="main" class="max-w-screen-xl m-auto">
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </div>

            @livewireScriptConfig

            @stack('scripts')
        </div>
    </body>
</html>
