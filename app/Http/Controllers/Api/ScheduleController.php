<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Schedule;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    use ApiResponse;

    public function index(){
        $response = Schedule::all();
        return $this->apiSuccess($response);
    }

    public function show($id){
        $response = Schedule::where('id', $id)->first();
        return $this->apiSuccess($response);
    }

    public function show_by_customer($customer_id){
        $orders = Order::with('schedule')->where('customer_id', $customer_id)->first();

        if($orders != null){
            $from = strtotime(Carbon::now()->format('Y-m-d'));
            $to = strtotime($orders->schedule->date_end);
            $difference = ($to - $from) / 60 / 60 / 24;
            if($difference > 0){
                $response = Schedule::join('orders', 'schedules.id', '=', 'orders.schedule_id')
                            ->where('orders.customer_id', $customer_id)
                            ->where('orders.status', 'processing')
                            ->first();
                // return response()->json([$response], 200);
                return $this->apiSuccess([$response]);
            }else{
                return $this->apiError('Data is still empty!', 204);
            }
        }else{
            return $this->apiError('Data is still empty!', 400);
        }
    }

    public function show_by_driver($driver_id){
        $orders = Order::with('schedule')->where('driver_id', $driver_id)->first();
        $from = strtotime(Carbon::now()->format('Y-m-d'));
        $to = strtotime($orders->schedule->date_end);
        $difference = ($to - $from) / 60 / 60 / 24;

        if($difference > 0){
            $response = Schedule::join('orders', 'schedules.id', '=', 'orders.schedule_id')
                        ->where('orders.driver_id', $driver_id)
                        ->where('orders.status', 'processing')
                        ->first();
            // return response()->json([$response], 200);
            return $this->apiSuccess($response);
        }else{
            return $this->apiError('Data is still empty', 204);
        }
    }
}
