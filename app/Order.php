<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cartId','paymentId','userId', 'productVariationsId', 'quantity','totalAmount','coupenCode','discountAmount','payableAmount','status',
    ];
}
