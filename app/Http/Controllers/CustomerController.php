<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Tax;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(): \Illuminate\View\View
    {
        $customers = Customer::latest()->get();
        return view('customers.index', compact('customers'));
    }

    public function create(): \Illuminate\View\View
    {
        return view('customers.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'customer' => 'required|min:2|max:50|string',
            'email' => 'required|min:2|max:30|email',
            'contact' => 'required|min:2|max:30|string',
            'department' => 'required|min:2|max:50|string',
            'address1' => 'required|min:2|max:100|string',
            'address2' => 'required|min:2|max:100|string',
            'city' => 'required|min:2|max:30|string',
            'pincode' => 'required|min:5|max:10|string',
            'state' => 'required|min:2|max:30|string',
            'country' => 'required|exists:countries,name',
            'phone' => 'required|min:10|max:15|string',
            'mobile' => 'required|min:10|max:15|string',
            'tax_type' => 'required|exists:taxes,type',
            'gstn' => 'required|string|size:15',
            'pan' => 'required|string|size:10',
            'state_code' => 'required|min:2|max:2|string',
        ]);

        $country = Country::where('name', $validate['country'])->first();
        $tax = Tax::where('type', $validate['tax_type'])->first();
        $customer = Customer::firstOrCreate(['name' => $validate['customer']]);
        $department = Department::firstOrCreate(['name' => $validate['department']]);
        $address = $customer->addresses()->firstOrCreate(
            [
                'country_id' => $country->id,
                'address1' => $validate['address1'],
                'address2' => $validate['address2'],
                'city' => $validate['city'],
                'pincode' => $validate['pincode'],
                'state' => $validate['state'],
            ]
        );

        $address->contacts()->create([
            'department_id' => $department->id,
            'tax_id' => $tax->id,
            'name' => $validate['contact'],
            'email' => $validate['email'],
            'phone' => $validate['phone'],
            'mobile' => $validate['mobile'],
            'gstn' => $validate['gstn'],
            'pan' => $validate['pan'],
            'state_code' => $validate['state_code'],
        ]);

        return redirect('/customers');
    }

    public function show(Customer $customer): \Illuminate\View\View
    {
        return view('customers.show', compact('customer'));
    }
}
