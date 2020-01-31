<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId','sellerId', 'cartId', 'amount','paymentMode','referanceNo',
    ];
}
