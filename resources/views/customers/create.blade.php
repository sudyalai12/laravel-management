@extends('layouts.app')
@section('js')
@endsection
@section('content')
    <div class="form-box">
        <form method="POST" class="form customer-form" action="/customers">
            @csrf
            <div class="form-header">
                <h1>Customer Details</h1>
                <p>Enter the details of the customer</p>
            </div>
            <div class="form-block">
                <h2>Basic Details</h2>
                <x-form.field class="fb-200">
                    <x-form.label for="customer">Customer Name</x-form.label>
                    <x-form.input placeholder="Enter Customer Name" id="customer" type="text" name="customer"
                        value="{{ old('customer') }}" />
                    <x-form.error name="customer" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="email">Email</x-form.label>
                    <x-form.input placeholder="Enter Email" id="email" type="text" name="email"
                        value="{{ old('email') }}" />
                    <x-form.error name="email" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="contact">Contact Person</x-form.label>
                    <x-form.input placeholder="Enter Contact Person Name" id="contact" type="text" name="contact"
                        value="{{ old('contact') }}" />
                    <x-form.error name="contact" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="department">Department</x-form.label>
                    <x-form.input placeholder="Enter Department" id="department" type="text" name="department"
                        value="{{ old('department') }}" />
                    <x-form.error name="department" />
                </x-form.field>
            </div>

            <div class="form-block">
                <h2>Address Details</h2>
                <x-form.field class="fb-500">
                    <x-form.label for="address1">Address1</x-form.label>
                    <x-form.input placeholder="Enter Address" id="address1" type="text" name="address1"
                        value="{{ old('address1') }}" />
                    <x-form.error name="address1" />
                </x-form.field>
                <x-form.field class="fb-500">
                    <x-form.label for="address2">Address2</x-form.label>
                    <x-form.input placeholder="Enter Address" id="address2" type="text" name="address2"
                        value="{{ old('address2') }}" />
                    <x-form.error name="address2" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="city">City</x-form.label>
                    <x-form.input placeholder="Enter City" id="city" type="text" name="city"
                        value="{{ old('city') }}" />
                    <x-form.error name="city" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="pincode">Pin Code</x-form.label>
                    <x-form.input placeholder="Enter Pin Code" id="pincode" type="text" name="pincode"
                        value="{{ old('pincode') }}" />
                    <x-form.error name="pincode" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="state">State</x-form.label>
                    <x-form.input placeholder="Enter State" id="state" type="text" name="state"
                        value="{{ old('state') }}" />
                    <x-form.error name="state" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="country">Country</x-form.label>
                    <x-form.input placeholder="Enter Country" id="country" type="text" name="country"
                        value="{{ old('country') == '' ? 'India' : old('country') }}" />
                    <x-form.error name="country" />
                </x-form.field>
            </div>

            <div class="form-block">
                <h2>Contact Details</h2>
                <x-form.field class="fb-200">
                    <x-form.label for="phone">Phone Number</x-form.label>
                    <x-form.input placeholder="Enter Phone Number" id="phone" type="text" name="phone" value="{{ old('phone') }}" />
                    <x-form.error name="phone" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="mobile">Mobile Number</x-form.label>
                    <x-form.input placeholder="Enter Mobile Number" id="mobile" type="text" name="mobile" value="{{ old('mobile') }}" />
                    <x-form.error name="mobile" />
                </x-form.field>
            </div>

            <div class="form-block">
                <h2>Tax Details</h2>
                <x-form.field class="fb-100">
                    <x-form.label for="tax_type">SaleTax</x-form.label>
                    <x-form.input placeholder="Enter Tax Type" id="tax_type" type="text" name="tax_type"
                        value="{{ old('tax_type') == '' ? 'IGST' : old('tax_type') }}" />
                    <x-form.error name="tax_type" />
                </x-form.field>
                <x-form.field class="fb-100">
                    <x-form.label for="gstn">GST Number</x-form.label>
                    <x-form.input placeholder="Enter GST Number" id="gstn" type="text" name="gstn"
                        value="{{ old('gstn') }}" />
                    <x-form.error name="gstn" />
                </x-form.field>
                <x-form.field class="fb-100">
                    <x-form.label for="pan">PAN Number</x-form.label>
                    <x-form.input placeholder="Enter PAN Number" id="pan" type="text" name="pan"
                        value="{{ old('pan') }}" />
                    <x-form.error name="pan" />
                </x-form.field>
                <x-form.field class="fb-100">
                    <x-form.label for="state_code">State Code</x-form.label>
                    <x-form.input placeholder="Enter State Code" id="state_code" type="text" name="state_code"
                        value="{{ old('state_code') }}" />
                    <x-form.error name="state_code" />
                </x-form.field>
            </div>

            <div class="text-center">
                <x-button btntype="secondary" type="submit">Save</x-button>
            </div>
        </form>
    </div>
@endSection
