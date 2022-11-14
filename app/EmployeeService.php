<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeService extends Model {

    protected $guarded = [];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function service() {
        return $this->belongsTo(SalonService::class);
    }

}
