<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polyclinic extends Model
{
    protected $fillable = [
        'poly_master_id', 'health_agency_id',
    ];

    public function poly_master() {
        return $this->belongsTo('App\PolyMaster');
    }

    public function health_agency() {
        return $this->belongsTo('App\HealthAgency');
    }

    public function schedules() {
        return $this->hasMany('App\Schedule');
    }
}
