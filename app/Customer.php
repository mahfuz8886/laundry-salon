<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function address() {
        return $this->hasOne(CustomerAddress::class, 'customer_id');
    }
}
