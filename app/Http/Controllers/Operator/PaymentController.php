<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\HeaderTransaction;
use App\Models\Payment;
use App\Models\UserOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{

    public function index()
    {
        $title = 'Payment All Table';
        $tables = Payment::with('header_transaction')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function paid()
    {
        $title = 'Payment Table (Paid)';
        $tables = Payment::with('header_transaction')
                        ->where('status', 'paid')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function unpaid()
    {
        $title = 'Payment Table (Unpaid)';
        $tables = Payment::with('header_transaction')
                        ->where('status', 'unpaid')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function processing()
    {
        $title = 'Payment Table (Processing)';
        $tables = Payment::with('header_transaction')
                        ->where('status', 'processing')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function waiting()
    {
        $title = 'Payment Table (Done)';
        $tables = Payment::with('header_transaction')
                        ->where('status', 'waiting')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function canceled()
    {
        $title = 'Payment Table (Canceled)';
        $tables = Payment::with('header_transaction')
                        ->where('status', 'canceled')
                        ->get();
        return view('operators.payments.index', compact([
            'title',
            'tables'
        ]));
    }

    public function paid_put($txid)
    {
        $opr = UserOperator::where('user_id', Auth::user()->id)->first();
        HeaderTransaction::where('txid', $txid)->update([
            'user_operator_id' => $opr->id,
            'status' => 'paid'
        ]);

        Payment::where('txid', $txid)->update([
            'status' => 'paid'
        ]);

        $data = HeaderTransaction::with('user_customer')->with('user_seller')
                    ->where('txid', $txid)->first();
        
        $this->push_notif([
            'body' => 'Transaksi telah dikonfirmasi!',
            'title' => 'Transaction & Payment',
        ], $data->user_seller->user->fcm_token);

        return redirect()->to('/operator/payment/paid')
                    ->with('success', 'Data changed successfully!');
    }

    public function unpaid_put($txid)
    {
        $opr = UserOperator::where('user_id', Auth::user()->id)->first();
        HeaderTransaction::where('txid', $txid)->update([
            'user_operator_id' => $opr->id,
            'status' => 'unpaid'
        ]);

        Payment::where('txid', $txid)->update([
            'status' => 'unpaid'
        ]);

        return redirect()->to('/operator/payment/unpaid')
                    ->with('success', 'Data changed successfully!');
    }

    public function processing_put($txid)
    {
        $opr = UserOperator::where('user_id', Auth::user()->id)->first();
        HeaderTransaction::where('txid', $txid)->update([
            'user_operator_id' => $opr->id,
            'status' => 'processing'
        ]);

        Payment::where('txid', $txid)->update([
            'status' => 'processing'
        ]);

        return redirect()->to('/operator/payment/processing')
                    ->with('success', 'Data changed successfully!');
    }

    public function waiting_put($txid)
    {
        $opr = UserOperator::where('user_id', Auth::user()->id)->first();
        HeaderTransaction::where('txid', $txid)->update([
            'user_operator_id' => $opr->id,
            'status' => 'waiting'
        ]);

        Payment::where('txid', $txid)->update([
            'status' => 'waiting'
        ]);

        return redirect()->to('/operator/payment/waiting')
                    ->with('success', 'Data changed successfully!');
    }
}
