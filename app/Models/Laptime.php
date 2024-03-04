<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laptime extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'track_id',
        'date',
        'time'
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
