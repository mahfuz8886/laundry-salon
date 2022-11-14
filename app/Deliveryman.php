<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveryman extends Model
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
        return DeliverymanAgent::where('deliveryman_id', $this->id)->pluck('agent_id')->toArray();
    }

    public function agents()
    {
        return $this->hasMany(DeliverymanAgent::class, 'deliveryman_id');
    }

    public function agentDetails()
    {
        $agent_ids = DeliverymanAgent::where('deliveryman_id', $this->id)->pluck('agent_id');
        return Agent::whereIn('id', $agent_ids)->get();
    }

    public function areaDetails()
    {
        $area_ids = DeliverymanArea::where('deliveryman_id', $this->id)->pluck('area_id');
        return Area::whereIn('id', $area_ids)->get();
    }

    public function educations()
    {
        return $this->hasMany(DeliverymanEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(DeliverymanExperience::class);
    }

    public function paymentSummary()
    {
        return [
            'total_parcel' => Parcel::where('status', '>', 1)->where('deliverymanId', $this->id)->count(),
            'total_amount' => Parcel::where('status', '>', 1)->where('deliverymanId', $this->id)->sum('deliveryman_amount'),
            'total_paid' => Parcel::where('status', '>', 1)->where('deliverymanId', $this->id)->sum('deliveryman_paid'),
            'total_due' => Parcel::where('status', '>', 1)->where('deliverymanId', $this->id)->sum('deliveryman_due'),
        ];
    }
}
