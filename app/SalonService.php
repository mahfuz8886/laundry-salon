<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalonService extends Model {

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(SalonCategory::class,'category_id','id');
    }

    public function salonCategory() {
        return $this->belongsTo(SalonCategory::class,'category_id','id');
    }

    public function salonParentService()
    {
        return $this->belongsTo(SalonParentService::class, 'parent_service_id');
    }

    public function employee()
    {
        return $this->hasMany(EmployeeService::class,'service_id','id')->with('employee');
    }

}
