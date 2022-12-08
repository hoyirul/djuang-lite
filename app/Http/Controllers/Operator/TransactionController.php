<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Transaction Table';
        $drivers = User::where('role_id', 3)->get();
        $tables = Order::with('customer')->with('driver')->with('schedule')->get();
        return view('operators.transactions.index', compact([
            'title', 'tables', 'drivers'
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Transaction Table';
        $tables = Order::where('id', $id)->first();
        return view('operators.transactions.show', compact([
            'title',
            'tables'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Transaction Table';
        $drivers = User::where('role_id', 3)->where('status', 'unused')->get();
        $tables = Order::with('customer')->with('driver')->with('schedule')->where('id', $id)->first();
        return view('operators.transactions.edit', compact([
            'title', 'tables', 'drivers'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'required',
            'total' => 'required',
        ]);

        User::where('id', $request->driver_id)->update([
            'status' => 'used'
        ]);

        Order::where('id', $id)->update([
            'driver_id' => $request->driver_id,
            'total' => $request->total,
            'status' => 'processing',
        ]);

        return redirect()->to('/operator/transaction')
                    ->with('success', 'Data changed successfully!');
    }
}
