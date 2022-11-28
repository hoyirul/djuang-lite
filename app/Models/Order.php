<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $primaryKey = 'id';
    protected $fillable = [
        'id', 'customer_id', 'driver_id', 'schedule_id','order_date', 'total', 'status'
    ];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function driver(){
        return $this->belongsTo(User::class, 'driver_id', 'id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
