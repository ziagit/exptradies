<?php

namespace App\Http\Controllers;

use App\About;
use App\Address;
use App\City;
use App\Company;
use App\Employee;
use App\EmployeeFaq;
use App\EmployerFaq;
use App\Post;
use App\Privacy;
use App\Service;
use App\Term;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about(){
        $data = About::all();
        return response()->json($data);
    }

    public function employee(){
        $data = EmployeeFaq::all();
        return response()->json($data);
    }

    public function employer(){
        $data = EmployerFaq::all();
        return response()->json($data);
    }

    public function privacy(){
        $data = Privacy::first();
        return response()->json($data);
    }

    public function terms(){
        $data = Term::first();
        return response()->json($data);
    }

    public function services(){
        $data = Service::with('steps.options')->paginate(20);
        return response()->json($data);
    }

    // public function businesses(){
    //     $data = Employee::whereNotNull('business_abn')
    //     ->whereNotNull('business_name')
    //     ->with('reviews','user','services')->paginate(10);
    //     return response()->json($data);
    // }
    public function businesses()
    {
        $data = Employee::whereNotNull('business_abn')
            ->whereNotNull('business_name')
            ->with('reviews', 'user', 'services')
            ->whereHas('user', function ($query) {
                $query->where('status', '!=', 'Deleted');
            })
            ->paginate(10);
    
        return response()->json($data);
    }

    public function businessLatest(){
        $data = Employee::
        whereNotNull('business_abn')
        ->whereNotNull('business_name')
        ->whereHas('user', function ($query) {
            $query->where('status', '!=', 'Deleted');
        })
        ->with('reviews')->latest()->take(6)->get();
        return response()->json($data);
    }

    public function cities(){
        $data = City::all();
        return response()->json($data);
    }

    public function posts(){
        $posts = Post::with('address', 'service', 'employee', 'options')
            ->paginate(12);
        return response()->json($posts);
    }

    public function postLatest(){
        $posts = Post::with('address', 'service', 'employee')->latest()->take(10)
            ->get();
        return response()->json($posts);
    }

    public function searchPost(Request $request){
        $keywords = $request->keywords;
        $data = Post::with('address', 'service', 'employee', 'options')
        ->where('note', 'like', '%' . $keywords . '%')
        ->orWhereHas('service', function($q)use ($keywords){
            $q->where('name','like','%'.$keywords.'%');
            $q->orWhere('type','like','%'.$keywords.'%');
        })
        ->orWhereHas('address', function($q)use ($keywords){
            $q->where('zip','like','%'.$keywords.'%');
            $q->orWhere('city','like','%'.$keywords.'%');
            $q->orWhere('formatted_address','like','%'.$keywords.'%');

        })
        ->paginate(10);
        return response()->json($data);
    }

    public function searchBusiness(Request $request){
        $keywords = $request->keywords;

        $data = Employee::query()
        ->leftJoin('business_addresses', 'employees.id', '=', 'business_addresses.employee_id')
        ->leftJoin('employee_service', 'employees.id', '=', 'employee_service.employee_id')
        ->leftJoin('services', 'employee_service.service_id', '=', 'services.id')
        ->whereNotNull('employees.business_abn')
        ->where(function ($query) use ($keywords) {
            $query->where('employees.business_name', 'LIKE', '%' . $keywords . '%')
                ->orWhere('business_addresses.address', 'LIKE', '%' . $keywords . '%')
                ->orWhere('services.name', 'LIKE', '%' . $keywords . '%');
        })
        ->distinct()
        ->with('reviews','user','services')->paginate(10);
        return response()->json($data);

    }

    public function steps($id)
    {
        $service = Service::with('steps')->find($id);
        return response()->json($service);
    }

    public function company(){
        $data = Company::get(['phone','address']);
        return response()->json($data);
    }
}
