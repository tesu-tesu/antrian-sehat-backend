<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolyMaster extends Model
{
    protected $fillable = [
        'name',
    ];

    public function polyclinics() {
        return $this->hasMany('App\Polyclinic');
    }
}
