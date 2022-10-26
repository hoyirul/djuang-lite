<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'user_id', 'invoice', 'evidance_of_transfer', 'paid_date', 'pay', 'status'
    ];

    public function order(){
        $this->belongsTo(Order::class, 'order_id', 'id');
    }
    
    public function user(){
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}