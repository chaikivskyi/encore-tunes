@extends('layout.one-column')

@section('content')
    <img class="hidden lg:block" src="{{ URL::asset('media/home/main.jpeg') }}" />
    <img class="lg:hidden" src="{{ URL::asset('media/home/main-mobile.jpg') }}" />

    <livewire:spotify.spotify-tracks />
@endsection
