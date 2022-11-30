<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Schedule;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    use ApiResponse;

    public function index(){
        $response = Order::all();
        return $this->apiSuccess($response);
    }

    public function store(OrderRequest $request){
        $validated = $request->validated();

        $from = strtotime($validated['date_start']);
        $to = strtotime($validated['date_end']);
        $difference = ($to - $from) / 60 / 60 / 24;

        if($difference <= 7){
            return $this->apiError('Minimum schedule of 7 days!', 400);
        }

        Schedule::create([
            'date_start' => $validated['date_start'],
            'date_end' => $validated['date_end'],
            'pickup_address' => $validated['pickup_address'],
            'destination_address' => $validated['destination_address'],
            'pickup_return_address' => $validated['pickup_return_address'],
            'time_pickup' => $validated['time_pickup'],
            'time_return' => $validated['time_return'],
            'information' => $validated['information'],
        ]);

        $row = Schedule::latest()->first();
        $id = strtoupper('TX-'.Str::random(10));
        Order::create([
            'id' => $id,
            'customer_id' => $validated['customer_id'],
            'driver_id' => 0,
            'schedule_id' => $row->id,
            'order_date' => Carbon::now(),
            'total' => 0,
            'status' => 'pending',
        ]);

        Payment::create([
            'order_id' => $id,
            'user_id' => $validated['customer_id'],
            'invoice' => 'INV-'.strtoupper(Str::random(10)),
            'evidence_of_transfer' => null,
            'paid_date' => null,
            'status' => 'unpaid'
        ]);

        $response = Order::with('schedule')->where('id', $id)->orderBy('created_at', 'DESC')->get();
        return $this->apiSuccess($response);
    }

    public function show_by_customer($customer_id){
        $response = Order::with('schedule')->where('customer_id', $customer_id)->orderBy('created_at', 'DESC')->get();
        return $this->apiSuccess($response);
    }

    public function show_by_driver($driver_id){
        $response = Order::with('schedule')->where('driver_id', $driver_id)->orderBy('created_at', 'DESC')->get();
        return $this->apiSuccess($response);
    }

    public function show($id){
        $response = Order::where('id', $id)->first();
        return $this->apiSuccess($response);
    }
}
