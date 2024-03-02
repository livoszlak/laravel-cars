<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'model',
        'user_id'
    ];

    /*     protected function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    } */
}
