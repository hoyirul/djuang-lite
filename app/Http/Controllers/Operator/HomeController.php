<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $monthly = 0;
        $annual = 0;
        $transactions = 0;
        $users = User::count();
        $title = 'Dashboard';
        return view('operators.home.index', compact([
            'title', 'monthly', 'annual', 'transactions', 'users'
        ]));
    }
}
