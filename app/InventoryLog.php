<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $guarded = [];
    
    public function item() {
        return $this->belongsTo(LaundryItem::class);
    }

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
