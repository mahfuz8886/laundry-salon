<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaundryProductBranch extends Model
{
    protected $guarded = [];

    public function hub() {
        return $this->belongsTo(Hub::class,'laundry_branch_id','id');
    }

    


}
