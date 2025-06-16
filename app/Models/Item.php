<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'nama_item',
        'uom',
        'harga_beli',
        'harga_jual',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
