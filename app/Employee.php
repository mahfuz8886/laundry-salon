<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function agentIds()
    {
        return EmployeeAgent::where('employee_id', $this->id)->pluck('agent_id')->toArray();
    }

    public function agents()
    {
        return $this->hasMany(EmployeeAgent::class, 'employee_id');
    }
    public function agentDetails()
    {
        $agent_ids = EmployeeAgent::where('employee_id', $this->id)->pluck('agent_id');
        return Agent::whereIn('id', $agent_ids)->get();
    }

    public function areaDetails()
    {
        $area_ids = EmployeeArea::where('employee_id', $this->id)->pluck('area_id');
        return Area::whereIn('id', $area_ids)->get();
    }

    public function educations()
    {
        return $this->hasMany(EmployeeEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(EmployeeExperience::class);
    }

    public function salon_booking_items() {
        return $this->hasMany(SalonBookingItem::class);
    }//mf

    public function account_head() {
        return $this->belongsTo(AccountHead::class, 'id', 'user_id')->where('head_type', 7)->with('tot_commission', 'tot_paid_commission', 'today_commission', 'advance');
        //return $this->belongsTo(AccountHead::class, 'id', 'user_id')->where('head_type', 7)->with('today_commission');
    }
}
