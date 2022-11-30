<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class PlottingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Plotting Table';
        $drivers = User::where('role_id', 3)->get();
        $tables = Order::with('customer')->with('driver')->with('schedule')->get();
        return view('operators.plottings.index', compact([
            'title', 'tables', 'drivers'
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
        $title = 'Plotting Table';
        $drivers = User::where('role_id', 3)->get();
        $tables = User::with('role')->where('id', $id)->first();
        return view('operators.plottings.edit', compact([
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
        ]);

        Order::where('id', $id)->update([
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->to('/operator/plotting')
                    ->with('success', 'Data changed successfully!');
    }
}
