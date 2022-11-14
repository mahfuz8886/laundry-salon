<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickupman extends Model
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
        return PickupmanAgent::where('pickupman_id', $this->id)->pluck('agent_id')->toArray();
    }

    public function agents()
    {
        return $this->hasMany(PickupmanAgent::class, 'pickupman_id');
    }

    public function agentDetails()
    {
        $agent_ids = PickupmanAgent::where('pickupman_id', $this->id)->pluck('agent_id');
        return Agent::whereIn('id', $agent_ids)->get();
    }

    public function areaDetails()
    {
        $area_ids = PickupmanArea::where('pickupman_id', $this->id)->pluck('area_id');
        return Area::whereIn('id', $area_ids)->get();
    }

    public function educations()
    {
        return $this->hasMany(PickupmanEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(PickupmanExperience::class);
    }

    public function paymentSummary()
    {
        return [
            'total_parcel' => Parcel::where('status', '>', 1)->where('pickupmanId', $this->id)->count(),
            'total_amount' => Parcel::where('status', '>', 1)->where('pickupmanId', $this->id)->sum('pickupman_amount'),
            'total_paid' => Parcel::where('status', '>', 1)->where('pickupmanId', $this->id)->sum('pickupman_paid'),
            'total_due' => Parcel::where('status', '>', 1)->where('pickupmanId', $this->id)->sum('pickupman_due'),
        ];
    }
}
