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
        'pickup_address',
        'destination_address',
        'pickup_return_address',
        'time_pickup',
        'time_return',
        'information',
    ];

    public function order(){
        return $this->hasMany(Order::class);
    }
}
