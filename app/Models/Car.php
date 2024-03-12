<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'model',
        'user_id',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function laptimes(): HasMany
    {
        return $this->hasMany(Laptime::class, 'car_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
