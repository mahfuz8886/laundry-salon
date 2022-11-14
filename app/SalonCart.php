<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonCart extends Model
{
    protected $guarded = [];
    
    public function billing() {
        return $this->belongsTo(CustomerAddress::class,'billing_id', 'id')
            ->with('division')->with('district')->with('thana');
    }
}
