<?php

namespace App\Filament\Resources;

use App\Customer\Enums\RequestStateEnum;
use App\Customer\Models\AvailabilityRequest;
use App\Filament\Pages\Customer\ListAvailabilityRequest;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class AvailabilityRequestResource extends Resource
{
    protected static ?string $model = AvailabilityRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('contact_data')
                    ->searchable(),
                TextColumn::make('comment'),
                TextColumn::make('state')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        RequestStateEnum::Approved->value => 'success',
                        RequestStateEnum::Rejected->value => 'danger',
                        RequestStateEnum::Pending->value => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('state')
                    ->options(array_column(RequestStateEnum::cases(), 'name', 'value'))
            ])
            ->actions([
                Action::make('Approve')
                    ->action(function (Model $record) {
                        $record->update(['state' => 'approved']);
                    })
                    ->color('success')
                    ->icon('heroicon-o-check'),
                Action::make('Reject')
                    ->action(function (Model $record) {
                        $record->update(['state' => 'rejected']);
                    })
                    ->color('danger')
                    ->icon('heroicon-o-x-mark')
                    ->requiresConfirmation(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAvailabilityRequest::route('/'),
        ];
    }
}
