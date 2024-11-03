<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
        ];

        $messages = [
            'required' => 'Vänligen fyll i alla fält.',
            'first_name.max' => 'Förnamnet får inte överstiga 255 tecken.',
            'last_name.max' => 'Efternamnet får inte överstiga 255 tecken.',
            'phone.max' => 'Telefonnummret får inte överstiga 255 tecken.',
            'address.max' => 'Adressen får inte överstiga 255 tecken.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $customer = new Customer;
        
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        $customer->save();

        session()->flash('status', 'En ny kund har skapats');
        return back();
    }

    public function index()
    {
        $customers = Customer::paginate(10);
        return view('search_customer')->with('customers', $customers);
    }
}
