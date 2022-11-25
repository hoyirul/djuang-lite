<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponse;

    public function index(){
        $response = Order::all();
        return $this->apiSuccess($response);
    }

    public function show_by_customer($customer_id){
        $response = Order::where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();
        return $this->apiSuccess($response);
    }

    public function show_by_driver($driver_id){
        $response = Order::where('driver_id', $driver_id)->orderBy('created_at', 'DESC')->get();
        return $this->apiSuccess($response);
    }

    public function show($id){
        $response = Order::where('id', $id)->first();
        return $this->apiSuccess($response);
    }
}
