<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderBilling extends Model
{
    protected $guarded = [];

    public function division() {
        return $this->belongsTo(Division::class,'region_id','id');
    }

    public function district() {
        return $this->belongsTo(District::class,'city_id', 'id');
    }

    public function thana() {
        return $this->belongsTo(Thana::class,'area_id', 'id');
    }
}
