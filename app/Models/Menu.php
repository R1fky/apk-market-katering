<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'description',
        'photo',
    ];

    // public function merchant()
    // {
    //     return $this->belongsTo(Merchant::class);
    // }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }
}
