@extends('layout.one-column')

@section('content')
    <img class="hidden lg:block w-full max-h-[550px] object-cover" src="{{ URL::asset('media/home/main.jpeg') }}" />
    <img class="lg:hidden w-full max-h-124 object-cover" src="{{ URL::asset('media/home/main-mobile.jpg') }}" />

    <div class="w-full border-b-2 my-5 px-5 lg:p-0">
        <h2 id="tracks-header" class="text-4xl font-extrabold mb-2">Tracks</h2>
    </div>

    <livewire:spotify.spotify-tracks />

    @include('components.contact-block')
@endsection
