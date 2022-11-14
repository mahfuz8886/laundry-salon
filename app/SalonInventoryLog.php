<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonInventoryLog extends Model
{
    protected $guarded = [];
    
    public function item() {
        return $this->belongsTo(SalonItem::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
