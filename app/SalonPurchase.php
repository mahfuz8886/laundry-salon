<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonPurchase extends Model
{
    protected $guarded = [];

    public function branch() {
        return $this->belongsTo(Hub::class, 'branch_id','id');
    }
}
