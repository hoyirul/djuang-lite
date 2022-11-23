<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Role Table';
        $tables = Role::withCount('user')->get();
        dd($tables);
        return view('operators.roles.index', compact([
            'title',
            'tables'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Role Table';
        return view('operators.roles.create', compact([
            'title'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);

        Role::create([
            'role' => $request->role,
        ]);

        return redirect()->to('/operator/role')
                    ->with('success', 'Data added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Role Table';
        $tables = Role::where('id', $id)->first();
        return view('operators.roles.show', compact([
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
        $title = 'Role Table';
        $tables = Role::where('id', $id)->first();
        return view('operators.roles.edit', compact([
            'title', 'tables'
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
            'role' => 'required',
        ]);

        Role::where('id', $id)->update([
            'role' => $request->role,
        ]);

        return redirect()->to('/operator/role')
                    ->with('success', 'Data changed successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = User::where('role_id', $id)->first();
        if($role != null){
            return redirect('/operator/role')->with('danger', 'This role ('.$role->role.') is still used by user!');
        }else{
            Role::where('id', $id)->delete();
            return redirect('/operator/role')->with('success', 'Data deleted successfully!');
        }
    }
}
