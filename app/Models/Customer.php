<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'nama_customer',
        'alamat',
        'telp',
        'fax',
        'email',
    ];
}
