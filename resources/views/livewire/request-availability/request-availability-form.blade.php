<div>
    @auth()
        <form x-data="{
beforeSubmit: function () {
    $wire.set('date_from', $store.requestAvailabilityDateStart);
    $wire.set('date_to', $store.requestAvailabilityDateEnd);
}}" wire:submit="submit" x-on:submit.prevent="beforeSubmit">
            <div>
                <x-input-label for="contact-data-comment" :value="__('Contact Data')"/>
                <x-text-input id="contact-data-comment" type="text" wire:model="contact_data" name="contact_data" autofocus
                              placeholder="Email, Phone, Instagram, etc..."/>
                <x-input-error :messages="$errors->get('contact_data')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label for="request-availability-comment" :value="__('Comment')"/>
                <x-textarea id="request-availability-comment" type="textbox" wire:model="comment" name="comment" autofocus/>
                <x-input-error :messages="$errors->get('comment')" class="mt-2"/>
            </div>

            <div class="mt-4 text-right">
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    @endauth

    @guest
        <div class="text-lg text-yellow-500">Please login to be able to request availability</div>
    @endguest

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('requestAvailabilityDateStart');
                Alpine.store('requestAvailabilityDateEnd');
            });
        </script>
    @endpush
</div>
