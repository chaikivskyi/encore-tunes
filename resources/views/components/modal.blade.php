<template x-teleport="body">
    <div
        x-data="{ show: false }"
        x-show="show"
        x-on:open-modal.window="show = ($event.detail.name === '{{ $name }}')"
        x-on:close-modal.window="show = false"
        x-on:keydown.escape.window="show = false"
        class="bg-black/25 bg-opacity-100 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full flex"
        x-transition.opacity
    >
        <div class="sm:max-w-lg sm:w-full m-3 sm:mx-auto bg-white rounded" x-on:click.stop.outside="show = false">
            <div class="p-4 border-grey-600 border-b flex items-center">
                <h3 class="text-xl">{{ $title }}</h3>
                <button x-on:click="show = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</template>
