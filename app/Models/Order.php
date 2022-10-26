<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $fillable = [
        'id', 'order_date', 'total', 'status'
    ];

    public function user_order_schedule(){
        $this->hasOne(UserOrderSchedule::class);
    }
}
