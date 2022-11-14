<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
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
    public function thanas()
    {
        return $this->hasMany(AgentThana::class, 'agent_id');
    }
    public function thanaDetails()
    {
        return Thana::whereIn('id', AgentThana::where('agent_id', $this->id)->pluck('thana_id'))->get();
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
