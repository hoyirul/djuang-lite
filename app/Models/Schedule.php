<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'time_departure',
        'time_arrival',
        'address',
        'information',
    ];

    public function uuser_order_schedule(){
        $this->hasOne(UserOrderSchedule::class);
    }
}
