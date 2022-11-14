<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonPurchaseItem extends Model
{
    protected $guarded = [];

    public function salon_item() {
        return $this->belongsTo(SalonItem::class, 'item_id', 'id');
    }
}
