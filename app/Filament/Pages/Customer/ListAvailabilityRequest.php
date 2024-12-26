<?php

namespace App\Filament\Pages\Customer;

use App\Filament\Resources\AvailabilityRequestResource;
use Filament\Resources\Pages\ListRecords;

class ListAvailabilityRequest extends ListRecords
{
    protected static string $resource = AvailabilityRequestResource::class;
}
