<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'date',
        'detail',
    ];

    public function eventTimes(): HasMany
    {
        return $this->hasMany(EventTimes::class, 'event_id', 'id');
    }
}
