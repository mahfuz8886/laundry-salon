<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonTransaction extends Model
{
    protected $guarded = [];

    public function account_head() {
        return $this->belongsTo(AccountHead::class, 'account_head_id', 'id');
    }

}
