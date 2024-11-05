<?php

namespace App\Filament\Pages\Spotify;

use App\Spotify\Enums\SpotifySearchTypeEnum;
use App\Spotify\Services\Adapter\Artists;
use App\Spotify\Services\Adapter\Search;
use App\Spotify\Settings\SpotifySettings as SpotifySettingsModel;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class SpotifySettings extends SettingsPage
{
    protected static ?string $navigationGroup = 'Spotify';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = SpotifySettingsModel::class;

    protected static ?string $title = 'Settings';

    public function form(Form $form): Form
    {
        /** @var Search $spotifyService */
        $spotifyService = \app(Search::class);
        /** @var Artists $spotifyArtists */
        $spotifyArtists = app(Artists::class);

        $artistSearchCallback = function (string $query) use ($spotifyService): array {
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
            } catch (\Throwable) {
                return [];
            }
        };

        $optionLabelCallback = function ($value) use ($spotifyArtists): ?string {
            try {
                return $spotifyArtists->getArtist($value)->name;
            } catch (\Throwable) {
                return null;
            }
        };

        return $form
            ->extraAttributes(['class' => 'max-w-md'])
            ->schema([
                Select::make('artist')
                    ->label('Artist')
                    ->searchable()
                    ->searchDebounce(500)
                    ->getSearchResultsUsing($artistSearchCallback)
                    ->getOptionLabelUsing($optionLabelCallback),
            ]);
    }
}
