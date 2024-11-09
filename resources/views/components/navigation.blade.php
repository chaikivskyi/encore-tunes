<div class="text-white" x-data="{ expanded: false }">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <div class="flex lg:flex-1">
            <a href="#" class="-m-1.5 p-1.5">
                <span class="font-bold text-3xl">Oruga Mikuru</span>
            </a>
        </div>
        <div class="flex gap-16">
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#" class="text-sm font-semibold leading-6">Contact</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#" class="text-sm font-semibold leading-6">Videos</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#" class="text-sm font-semibold leading-6">Photo</a>
            </div>
        </div>
        <div class="w-7 h-6 block relative cursor-pointer lg:hidden" x-on:click="expanded = ! expanded">
            <span class="inline-block">
                <span :class="expanded ? 'rotate--45 top-3' : 'top-0'" class="absolute h-0.5 w-full bg-white duration-500"></span>
                <span :class="expanded ? 'rotate-45 top-3' : 'top-2'" class="absolute h-0.5 w-full bg-white duration-500"></span>
                <span :class="expanded ? 'hidden' : ''" class="absolute h-0.5 w-full bg-white top-4"></span>
            </span>
        </div>
    </nav>
    <div class="lg:hidden h-screen w-screen fixed bg-slate-800 opacity-75 transition duration-500 delay-300"
         :class="expanded ? '' : 'translate-x-full'"
         x-cloak
    ></div>
    <ul x-show="expanded"
        x-cloak
        class="absolute text-center w-full lg:hidden"
        x-transition:enter="transition ease-out duration-300 delay-500"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
    >
        <li class="mt-10"><a class="text-3xl" href="#">Home</a></li>
        <li class="mt-10"><a class="text-3xl" href="#">About Us</a></li>
    </ul>
</div>
