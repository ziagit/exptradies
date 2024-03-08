<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function __invoke(Request $data)
    {
        return "hi.";
    }
    public function byPhone($data)
    {
        return "register by phone";
    }
    public function byEmail($data)
    {
        return "signi by meail";
    }
}
