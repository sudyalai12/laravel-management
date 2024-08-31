<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tax;
use Illuminate\Http\Request;

class AutocompleteController extends Controller
{
    function fetch(Request $request): \Illuminate\Http\JsonResponse
    {
        $column = $request->get('column');
        $search = $request->get('search');
        $customer = $request->get('customer');
        $supplier = $request->get('supplier');

        $data = match ($column) {
            'customer' => Customer::where('name', 'LIKE', "$search%")
                ->select('name')
                ->orderBy('name')
                ->get()
                ->pluck('name'),
            'contact' => Contact::whereHas('address.customer', fn($q) => $q->where('name', $customer))
                ->select('name')
                ->orderBy('name')
                ->get()
                ->pluck('name'),
            'department' => Department::where('name', 'LIKE', "$search%")
                ->select('name')
                ->orderBy('name')
                ->get()
                ->pluck('name'),
            'country' => Country::where('name', 'LIKE', "$search%")
                ->select('name')
                ->orderBy('name')
                ->get()
                ->pluck('name'),
            'tax_type' => Tax::where('type', 'LIKE', "$search%")
                ->select('type')
                ->orderBy('type')
                ->get()
                ->pluck('type'),
            'address1' => Address::whereHas('customer', fn($q) => $q->where('name', $customer))
                ->select('address1')
                ->orderBy('address1')
                ->get()
                ->pluck('address1'),
            'supplier' => Supplier::where('name', 'LIKE', "$search%")
                ->select('name')
                ->orderBy('name')
                ->get()
                ->pluck('name')
                ->prepend('All Suppliers'),
            'product' => Product::whereHas('supplier', function ($q) use ($supplier) {
                $q->when($supplier != 'All Suppliers', function ($q) use ($supplier) {
                    $q->where('name', $supplier);
                });
            })->select('name')
                ->where('name', 'LIKE', "$search%")
                ->orderBy('name')
                ->get()
                ->pluck('name'),
            default => []
        };
        return response()->json($data);
    }

    function fetchCustomerDetails(Request $request): \Illuminate\Http\JsonResponse
    {
        $customer = $request->get('customer');
        $address = $request->get('address');
        $contact = $request->get('contact');
        if ($customer && $address) {
            $address = Address::where('address1', $address)->first();
            if (!$address) {
                return response()->json([]);
            }
            $contact = $address->contacts()->first();
            if (!$contact) {
                return response()->json([]);
            }
            $data = [
                'customer' => $customer,
                'address1' => $address->address1,
                'address2' => $address->address2,
                'city' => $address->city,
                'state' => $address->state,
                'pincode' => $address->pincode,
                'country' => $address->country->name,
                'contact' => $contact->name,
                'email' => $contact->email,
                'department' => $contact->department->name,
                'phone' => $contact->phone,
                'mobile' => $contact->mobile,
                'tax_type' => $contact->taxType->name,
                'gstn' => $contact->gstn,
                'pan' => $contact->pan
            ];

            return response()->json($data);
        }
        if ($customer && $contact) {
            $contact = Contact::where('name', $contact)->first();
            if (!$contact) {
                return response()->json([]);
            }
            $address = $contact->address()->first();
            if (!$address) {
                return response()->json([]);
            }
            $data = [
                'customer' => $customer,
                'address1' => $address->address1,
                'address2' => $address->address2,
                'city' => $address->city,
                'state' => $address->state,
                'pincode' => $address->pincode,
                'country' => $address->country->name,
                'contact' => $contact->name,
                'email' => $contact->email,
                'department' => $contact->department->name,
                'phone' => $contact->phone,
                'mobile' => $contact->mobile,
                'tax_type' => $contact->taxType->name,
                'gstn' => $contact->gstn,
                'pan' => $contact->pan
            ];
            return response()->json($data);
        }

        $customer = Customer::where('name', $customer)->first();
        if (!$customer) {
            return response()->json([]);
        }

        $addresses = $customer->addresses()->get();
        if (!$addresses) {
            return response()->json([]);
        }

        foreach ($addresses as $address) {
            $contact = $address->contacts()->first();
            if (!$contact) {
                continue;
            }
            $data = [
                'customer' => $customer->name,
                'address1' => $address->address1,
                'address2' => $address->address2,
                'city' => $address->city,
                'state' => $address->state,
                'pincode' => $address->pincode,
                'country' => $address->country->name,
                'contact' => $contact->name,
                'email' => $contact->email,
                'department' => $contact->department->name,
                'phone' => $contact->phone,
                'mobile' => $contact->mobile,
                'tax_type' => $contact->taxType->name,
                'gstn' => $contact->gstn,
                'pan' => $contact->pan
            ];
            return response()->json($data);
        }

        return response()->json([]);
    }
}
