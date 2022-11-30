<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\HeaderTransaction;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Schedule;

class PaymentController extends Controller
{

    public function index()
    {
        $title = 'Payment Table';
        $tables = Payment::with('order')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function show($txid)
    {
        $title = 'Payment Table';
        $tables = Payment::with('order')
                        ->where('order_id', $txid)
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function paid_put($txid)
    {
        $orders = Order::where('id', $txid)->first();

        Order::where('id', $txid)->update([
            'status' => 'done'
        ]);

        Payment::where('order_id', $txid)->update([
            'status' => 'paid'
        ]);

        Schedule::where('id', $orders->schedule_id)->update([
            'status' => 'done'
        ]);

        return redirect()->to('/operator/payment')
                    ->with('success', 'Data changed successfully!');
    }

    public function processing_put($txid)
    {
        $orders = Order::where('id', $txid)->first();

        Order::where('id', $txid)->update([
            'status' => 'processing'
        ]);

        Payment::where('order_id', $txid)->update([
            'status' => 'processing'
        ]);

        Schedule::where('id', $orders->schedule_id)->update([
            'status' => 'processing'
        ]);

        return redirect()->to('/operator/payment')
                    ->with('success', 'Data changed successfully!');
    }
}
