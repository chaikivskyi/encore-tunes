<?php

namespace App\Filament\Pages\Spotify;

use App\Spotify\Enums\SpotifySearchTypeEnum;
use App\Spotify\Services\Adapter\Albums;
use App\Spotify\Services\Adapter\Artists;
use App\Spotify\Services\Adapter\Search;
use App\Spotify\Settings\SpotifySettings as SpotifySettingsModel;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\SettingsPage;
use Throwable;

class SpotifySettings extends SettingsPage
{
    protected static ?string $navigationGroup = 'Spotify';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SpotifySettingsModel::class;

    protected static ?string $title = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->extraAttributes(['class' => 'max-w-md'])
            ->columns(1)
            ->schema([
                Select::make('artist')
                    ->label('Artist')
                    ->searchable()
                    ->searchDebounce(500)
                    ->reactive()
                    ->getSearchResultsUsing(fn (string $search) => $this->getArtistsList($search))
                    ->getOptionLabelUsing(fn (?string $value) => $this->getArtistsOptionsLabels($value))
                    ->afterStateUpdated(fn (Set $set) => $set('tracks', [])),
                Repeater::make('tracks')
                    ->schema([
                        Select::make('album')
                            ->options(fn (Get $get) => $get('../../artist') ? $this->getAlbumsList($get('../../artist')) : [])
                            ->required()
                            ->reactive(),
                        Select::make('track')
                            ->options(fn (Get $get) => $get('album') ? $this->getTracksList($get('album')): [])
                            ->required(),
                    ])
                    ->columns(2)
            ]);
    }

    private function getArtistsList(string $query): array
    {
        /** @var Search $spotifyService */
        $spotifyService = app(Search::class);

        try {
            return $spotifyService->search(
                $query,
                [SpotifySearchTypeEnum::Artist->value],
            )
                ->artists
                ->items
                ->reduce(function ($carry, $item) {
                    $carry[$item->id] = $item->name;
                    return $carry;
                }, []);
        } catch (Throwable) {
            return [];
        }
    }

    private function getArtistsOptionsLabels(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        /** @var Artists $spotifyArtists */
        $spotifyArtists = app(Artists::class);

        try {
            return $spotifyArtists->getArtist($value)->name;
        } catch (Throwable) {
            return null;
        }
    }

    private function getAlbumsList(?string $artistId): array
    {
        if (!$artistId) {
            return [];
        }

        /** @var Artists $spotifyArtists */
        $spotifyArtists = app(Artists::class);

        try {
            return $spotifyArtists->getArtistAlbums($artistId)
                ->items
                ->reduce(function ($carry, $item) {
                    $carry[$item->id] = $item->name;
                    return $carry;
                }, []);
        } catch (Throwable) {
            return [];
        }
    }

    private function getTracksList(?string $albumId): array
    {
        if (!$albumId) {
            return [];
        }

        /** @var Albums $spotifyArtists */
        $spotifyAlbums = app(Albums::class);

        try {
            return $spotifyAlbums->getAlbumTracks($albumId)
                ->items
                ->reduce(function ($carry, $item) {
                    $carry[$item->id] = $item->name;
                    return $carry;
                }, []);
        } catch (Throwable) {
            return [];
        }
    }
}
