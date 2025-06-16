<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'transaction_id',
        'customer_id',
        'quantity',
        'price',
        'amount',
        'session_id',
        'remarks',
        'do_number',
    ];

    // public function transactions(): HasMany
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    // Relasi many-to-many ke Item melalui Transaction
    public function items()
    {
        return $this->hasManyThrough(Item::class, Transaction::class, 'sales_id', 'id', 'id', 'item_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}
