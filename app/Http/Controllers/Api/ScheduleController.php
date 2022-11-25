<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Traits\ApiResponse;
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
}
