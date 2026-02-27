<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'merchant_id',
        'order_date',
        'delivery_date',
        'total_price',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    //order ke merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // order ke customer
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
