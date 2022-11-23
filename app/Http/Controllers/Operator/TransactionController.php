<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        $tables = Order::with('schedule')->with('customer')->with('driver')
                        ->get();
        return view('operators.transactions.index', compact([
            'title',
            'tables'
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
        $tables = Order::where('id', $id)->first();
        return view('operators.transactions.edit', compact([
            'title', 'tables'
        ]));
    }
}
