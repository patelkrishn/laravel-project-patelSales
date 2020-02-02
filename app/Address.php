<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId','sellerId','name','mobile','street','landmark','city','state','country','pincode',
    ];
}
