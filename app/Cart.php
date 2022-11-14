<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function shipping() {
        return $this->belongsTo(CustomerAddress::class,'shipping_id', 'id')
            ->with('division')->with('district')->with('thana');
    }

    public function billing() {
        return $this->belongsTo(CustomerAddress::class,'billing_id', 'id')
            ->with('division')->with('district')->with('thana');
    }
}
