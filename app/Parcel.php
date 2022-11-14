<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    protected $guarded = [];
    protected $appends = ['title', 'division_name', 'district_name', 'thana_name', 'area_name'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'merchantId');
    }

    public function pickupman()
    {
        return $this->belongsTo(Pickupman::class, 'pickupmanId');
    }

    public function deliveryman()
    {
        return $this->belongsTo(Deliveryman::class, 'deliverymanId');
    }

    public function weight()
    {
        return $this->belongsTo(Weight::class, 'productWeight', 'value');
    }
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

    public function parcelStatus()
    {
        return $this->belongsTo(Parceltype::class, 'status', 'id');
    }

    public function getTitleAttribute()
    {
        return $this->parcelStatus->title ?? '';
    }
    public function getDivisionNameAttribute()
    {
        return $this->division->name ?? '';
    }
    public function getDistrictNameAttribute()
    {
        return $this->district->name ?? '';
    }
    public function getThanaNameAttribute()
    {
        return $this->thana->name ?? '';
    }
    public function getAreaNameAttribute()
    {
        return $this->area->name ?? '';
    }
}
