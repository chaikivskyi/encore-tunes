<?php

namespace App\Event\Models;

use App\Event\Enums\EventStateEnum;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['contact_data', 'date_from', 'date_to', 'state', 'user_id', 'comment'];

    protected $attributes = [
        'state' => EventStateEnum::Pending->value,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithActiveStates(Builder $query): void
    {
        $query->whereIn('state', [EventStateEnum::Pending->value, EventStateEnum::Approved->value]);
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
