@extends('layouts.app')
@section('content')
    {{-- {{ $contacts }} --}}
    <h1 class="heading">Contact Persons</h1>
    <x-button btntype="secondary"><a href="/customers/create">Add new Customer</a></x-button>
    <x-table>
        <thead>
            <tr>
                <th>CPID</th>
                <th>CustomerName</th>
                <th>ContactPersonName</th>
                <th>Dept/Desig</th>
                <th>Address1</th>
                <th>Address2</th>
                <th>City</th>
                <th>Pincode</th>
                <th>State</th>
                <th>Country</th>
                <th>Phone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>TaxType</th>
                <th>GSTN</th>
                <th>PAN</th>
                <th>StateCode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td><a href="/contacts/{{ $contact->id }}">{{ $contact->id }}</a></td>
                    <td><a
                            href="/customers/{{ $contact->address->customer->id }}">{{ $contact->address->customer->name }}</a>
                    </td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->department->name }}</td>
                    <td>{{ $contact->address->address1 }}</td>
                    <td>{{ $contact->address->address2 }}</td>
                    <td>{{ $contact->address->city }}</td>
                    <td>{{ $contact->address->pincode }}</td>
                    <td>{{ $contact->address->state }}</td>
                    <td>{{ $contact->address->country->name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->mobile }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->tax->type }}</td>
                    <td>{{ $contact->gstn }}</td>
                    <td>{{ $contact->pan }}</td>
                    <td>{{ $contact->state_code }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
@endSection
