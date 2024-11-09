<?php

namespace App\Filament\Pages\ContactMe;

use App\ContactMe\Settings\ContactMeSettings;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ContactMeSettingsPage extends SettingsPage
{
    protected static ?string $navigationGroup = 'Contact Me';

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ContactMeSettings::class;

    protected static ?string $title = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->extraAttributes(['class' => 'max-w-md'])
            ->columns(1)
            ->schema([
                TextInput::make('email')->email(),
                TextInput::make('instagram'),
                TextInput::make('telegram')
            ]);
    }
}
