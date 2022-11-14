<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryTransectionInfo extends Model
{
    protected $guarded = [];

    public function income_transection() {
        return $this->hasMany(LaundryTransaction::class, 'ref_table_id', 'id')
                    ->where('comment', 'Laundry Income')
                    ->with('account_head');
    }

    public function expanse_transection() {
        return $this->hasMany(LaundryTransaction::class, 'ref_table_id', 'id')
                    ->where('comment', 'Laundry Expanse')
                    ->with('account_head');
    }
}
