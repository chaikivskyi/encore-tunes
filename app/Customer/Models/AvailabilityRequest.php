<?php

namespace App\Customer\Models;

use App\Customer\Enums\RequestStateEnum;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AvailabilityRequest extends Model
{
    use HasFactory;

    protected $fillable = ['contact_data', 'date_from', 'date_to', 'state', 'user_id'];

    protected $attributes = [
        'state' => RequestStateEnum::Pending->value,
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
