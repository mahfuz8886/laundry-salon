<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonPurchaseItem extends Model
{
    protected $guarded = [];

    public function salon_item() {
        return $this->belongsTo(SalonItem::class, 'item_id', 'id')->select('id','name','unit_id')->with('unit');
    }

    public function sale_items() {
        return $this->hasMany(SalonInventoryLog::class, 'item_id', 'item_id')->where('unit_id',$this->unit_id)->where('in_out', 'Out');
    }
}
