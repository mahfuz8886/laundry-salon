<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonCartItem extends Model
{

    public function salonCategory()
    {
        return $this->belongsTo(SalonCategory::class, 'category_id', 'id');
    }

    public function salonService()
    {
        return $this->belongsTo(SalonService::class, 'service_id', 'id');
    }

    public function employee() {
        return $this->hasMany(EmployeeService::class,'service_id','id')->with('employee');
    }
}
