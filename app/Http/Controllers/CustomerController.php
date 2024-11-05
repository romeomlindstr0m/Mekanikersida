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
            'email' => 'required|email:rfc|max:255',
            'city' => 'required|max:255',
            'postal_code' => 'required|max:255',
        ];

        $messages = [
            'required' => 'Vänligen fyll i alla fält.',
            'first_name.max' => 'Förnamnfältet får inte överstiga 255 tecken.',
            'last_name.max' => 'Efternamnfältet får inte överstiga 255 tecken.',
            'phone.max' => 'Telefonnummerfältet får inte överstiga 255 tecken.',
            'address.max' => 'Adressfältet får inte överstiga 255 tecken.',
            'email.email' => 'E-postadressfältet har ett ogiltigt format.',
            'email.max' => 'E-postadressfältet får inte överstiga 255 tecken.',
            'city.max' => 'Ortfältet får inte överstiga 255 tecken.',
            'postal_code.max' => 'Postnummerfältet får inte överstiga 255 tecken.',
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
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;

        $customer->save();

        session()->flash('status', 'En ny kund har skapats');
        return back();
    }

    public function index()
    {
        $customers = Customer::paginate(10);
        return view('search_customer')->with('customers', $customers);
    }

    public function edit(int $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        return view('edit_customer')->with('customer', $customer);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $rules = [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|email:rfc|max:255',
            'city' => 'required|max:255',
            'postal_code' => 'required|max:255',
        ];

        $messages = [
            'required' => 'Vänligen fyll i alla fält.',
            'first_name.max' => 'Förnamnfältet får inte överstiga 255 tecken.',
            'last_name.max' => 'Efternamnfältet får inte överstiga 255 tecken.',
            'phone.max' => 'Telefonnummerfältet får inte överstiga 255 tecken.',
            'address.max' => 'Adressfältet får inte överstiga 255 tecken.',
            'email.email' => 'E-postadressfältet har ett ogiltigt format.',
            'email.max' => 'E-postadressfältet får inte överstiga 255 tecken.',
            'city.max' => 'Ortfältet får inte överstiga 255 tecken.',
            'postal_code.max' => 'Postnummerfältet får inte överstiga 255 tecken.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $customer = Customer::find($id);

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->city = $request->city;
        $customer->postal_code = $request->postal_code;

        $customer->save();

        session()->flash('status', 'Kundinformationen har uppdaterats');
        return redirect()->route('customer.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            abort(404);
        }

        $customer->delete();
        session()->flash('status', 'Kunden har raderats');
        return back();
    }
}
