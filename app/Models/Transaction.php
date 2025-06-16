<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [

        'item_id',
        'quantity',
        'price',
        'amount',
        'session_id',
        'remarks',

    ];

    // Relasi ke Sale
    public function Sale(): HasMany
    {
        return $this->hasMany(Sale::class, 'transaction_id');
    }

    // Relasi ke Item
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
