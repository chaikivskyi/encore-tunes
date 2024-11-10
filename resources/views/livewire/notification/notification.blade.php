<div>
    @if($notification)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => Livewire.dispatch('clearNotification'), 3000)"
             class="fixed top-10 right-10 min-w-64 text-center animate-slide-down z-50 bg-{{ $this->getNotificationColor() }}-500 text-{{ $this->getNotificationColor() }}-50 rounded-lg "
             style="animation: slide-down 0.5s ease-out;">
            <div class="p-3">
                {{ $notification }}
            </div>
        </div>
    @endif
</div>
