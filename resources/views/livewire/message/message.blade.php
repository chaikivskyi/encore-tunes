<div>
    @if($message)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => Livewire.dispatch('clearMessage'), 3000)"
             class="fixed top-10 right-10 min-w-64 text-center animate-slide-down z-50 bg-green-500 text-green-50 rounded-lg "
             style="animation: slide-down 0.5s ease-out;">
            <div class="p-3">
                {{ $message }}
            </div>
        </div>
    @endif
</div>
