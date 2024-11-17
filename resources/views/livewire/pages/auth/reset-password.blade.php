<?php

use function Livewire\Volt\layout;

layout('layouts.one-column-no-header');
?>

<div class="flex items-center min-h-screen bg-gray-100 flex-col">
    <x-logo class="mt-auto"/>
    <div class="px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-auto mx-8 max-w-sm">
        <livewire:auth.reset-password-form />
    </div>
</div>
