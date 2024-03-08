<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Step;

class StepController extends Controller
{
    public function index(){
        $steps = Step::all();
        return response()->json($steps);
    }
    public function show($id)
    {
        $step = Step::with('options')->find($id);
        return response()->json($step);
    }
}
