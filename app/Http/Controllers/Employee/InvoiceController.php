<?php

namespace App\Http\Controllers\Employee;

use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index(){
        $emp = Employee::where('user_id', Auth::id())->first();

        $invoices = Invoice::where('employee_id',$emp->id)->paginate(10);
        return response()->json($invoices);
    }

    public function show($id){
        $invoice = Invoice::with('postWithService')->find($id);
        $company = Company::select('phone','abn','acn')->first();
        $employee = Employee::with('address')->where('user_id',Auth::id())->first();
        return response()->json(['invoice'=>$invoice,'company'=>$company,'employee'=>$employee]);
    }
}
