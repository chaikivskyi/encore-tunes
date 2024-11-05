<?php

namespace App\Spotify\Enums;

enum SpotifySearchTypeEnum: string
{
    case Album = 'album';
    case Artist = 'artist';
    case Playlist = 'playlist';
    case Track = 'track';
    case Show = 'show';
    case Episode  = 'episode';
    case Audiobook = 'audiobook';
}
