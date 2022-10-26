<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'schedule_id', 'order_id'
    ];

    public function order(){
        $this->belongsTo(Order::class, 'order_id', 'id');
    }
    
    public function user(){
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function schedule(){
        $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }
}
