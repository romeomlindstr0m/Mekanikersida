<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Customer;

class ProjectController extends Controller
{
    public function create(): View
    {
        $customers = Customer::all();
        return view('create_project')->with('customers', $customers);
    }
}
