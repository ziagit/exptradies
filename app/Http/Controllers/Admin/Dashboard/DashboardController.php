<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Earning;
use App\Employee;
use App\Employer;
use App\Http\Controllers\Controller;
use App\Post;

class DashboardController extends Controller
{
    public function employees(){
        $data = Employee::all();
        return response()->json($data);
    }
    public function employers(){
        $data = Employer::all();
        return response()->json($data);
    }
    public function posts(){
        $data = Post::all();
        return response()->json($data);
    }
    public function sales(){
        $data = Earning::all();
        return response()->json($data);
    }
}
