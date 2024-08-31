@extends('layouts.app')
@section('content')
    {{-- {{ $customer }} --}}
    <h1 class="heading">Customer Details</h1>
    <table class="table mb-1">
        <tbody>
            <tr>
                <th>Customer Name</th>
                <td>{{ $customer->name }}</td>
            </tr>
        </tbody>
    </table>
    <x-table>
        <thead>
            <tr>
                <th>CPID</th>
                <th>ContactPersonName</th>
                <th>Dept/Desig</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>City</th>
                <th>Pincode</th>
                <th>State</th>
                <th>Country</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>TaxType</th>
                <th>GSTN</th>
                <th>PAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customer->addresses as $address)
                @foreach ($address->contacts as $contact)
                    <tr>
                        <td><a href="/contacts/{{ $contact->id }}">{{ $contact->id }}</a></td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->department->name }}</td>
                        <td>{{ $address->address1 }}</td>
                        <td>{{ $address->address2 }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->pincode }}</td>
                        <td>{{ $address->state }}</td>
                        <td>{{ $address->country->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->mobile }}</td>
                        <td>{{ $contact->tax->type }}</td>
                        <td>{{ $contact->gstn }}</td>
                        <td>{{ $contact->pan }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </x-table>
@endSection
