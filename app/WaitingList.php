<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $fillable = [
        'user_id', 'schedule_id', 'barcode', 'registered_date', 'order_number', 'residence_number', 'status',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function schedule() {
        return $this->belongsTo('App\Schedule');
    }
}
