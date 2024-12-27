<?php

namespace App\Event\Models;

use App\Event\Enums\EventStateEnum;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['contact_data', 'date_from', 'date_to', 'state', 'user_id', 'comment'];

    protected $attributes = [
        'state' => EventStateEnum::Pending->value,
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'contact_data' => 'string',
            'comment' => 'string',
            'date_from' => 'date',
            'date_to' => 'date',
            'state' => 'string',
            'user_id' => 'integer'
        ];
    }
}
