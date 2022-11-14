<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonTransectionInfo extends Model
{
    protected $guarded = [];

    public function income_salon_transection() {
        return $this->hasMany(SalonTransaction::class, 'ref_table_id', 'id')
                    ->where('comment', 'Salon Income')
                    ->with('account_head');
    }

    public function expanse_salon_transection() {
        return $this->hasMany(SalonTransaction::class, 'ref_table_id', 'id')
                    ->where('comment', 'Salon Expanse')
                    ->with('account_head');
    }
}
