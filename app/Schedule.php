<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'polyclinic_id', 'day', 'time_open', 'time_close',
    ];

    public function waiting_lists() {
        return $this->hasMany('App\WaitingList');
    }

    public function polyclinic() {
        return $this->belongsTo('App\Polyclinic');
    }
}
