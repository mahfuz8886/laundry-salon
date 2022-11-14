<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
    protected $guarded = [];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
