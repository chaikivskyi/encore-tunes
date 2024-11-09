@extends('layout.one-column')

@section('content')
    <img class="hidden lg:block w-full max-h-[550px] object-cover" src="{{ URL::asset('media/home/main.jpeg') }}" />
    <img class="lg:hidden w-full max-h-124 object-cover" src="{{ URL::asset('media/home/main-mobile.jpg') }}" />

    <livewire:spotify.spotify-tracks />
    @include('components.contact-block')
@endsection
