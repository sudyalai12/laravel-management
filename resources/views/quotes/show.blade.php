@extends('layouts.app')
@section('js')
@endsection
@php
    $index = 1;
@endphp
@section('content')
    {{-- {{ $quote }} --}}
    <x-table class="mb-1">
        <tbody>
            <tr>
                <th>Customer Name</th>
                <td>
                    <a href="/customers/{{ $quote->contact->address->customer->id }}">{{ $quote->contact->address->customer->name }}
                    </a>
                </td>
                <th>Contact Person Name</th>
                <td><a href="/contacts/{{ $quote->contact->id }}">{{ $quote->contact->name }}</a></td>
                <th>Department Name</th>
                <td>{{ $quote->contact->department->name }}</td>
            </tr>
            <tr>
                <th>Address1</th>
                <td>{{ $quote->contact->address->address1 }}</td>
                <th>Address2</th>
                <td>{{ $quote->contact->address->address2 }}</td>
                <th>City</th>
                <td>{{ $quote->contact->address->city }}</td>
            </tr>
            <tr>
                <th>Pincode</th>
                <td>{{ $quote->contact->address->pincode }}</td>
                <th>State</th>
                <td>{{ $quote->contact->address->state }}</td>
                <th>Country</th>
                <td>{{ $quote->contact->address->country->name }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $quote->contact->phone }}</td>
                <th>Mobile</th>
                <td>{{ $quote->contact->mobile }}</td>
                <th>Email</th>
                <td>{{ $quote->contact->email }}</td>
            </tr>
            <tr>
                <th>Tax Type</th>
                <td>{{ $quote->contact->tax->type }}</td>
                <th>GST Number</th>
                <td>{{ $quote->contact->gstn }}</td>
                <th>PAN</th>
                <td>{{ $quote->contact->pan }}</td>
            </tr>
        </tbody>
    </x-table>

    <div class="form-box">
        <form method="POST" class="form quote-form" action="/quotes/{{ $quote->id }}">
            @csrf
            <div class="form-header">
                <h1>Add Item</h1>
            </div>
            <div class="form-block">
                <x-form.field class="fb-200">
                    <x-form.label for="supplier">Select a Supplier</x-form.label>
                    <x-form.input placeholder="Enter Supplier Name" id="supplier" type="text" name="supplier"
                        value="{{ old('supplier') == '' ? 'All Suppliers' : old('supplier') }}" />
                    <x-form.error name="supplier" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="product">Select a Product</x-form.label>
                    <x-form.input placeholder="Enter Product Name" id="product" type="text" name="product"
                        value="{{ old('product') }}" />
                    <x-form.error name="product" />
                </x-form.field>
                <x-form.field class="fb-200">
                    <x-form.label for="quantity">Quantity</x-form.label>
                    <x-form.input placeholder="Enter Quantity" id="quantity" type="number" name="quantity" value="1"
                        min="1" />
                    <x-form.error name="quantity" />
                </x-form.field>
            </div>

            <div class="text-center">
                <x-button btntype="secondary" type="submit">Add</x-button>
            </div>
        </form>
    </div>

    <x-table class="quote-table">
        <thead>
            <tr>
                <th>SNo</th>
                <th>ProductName</th>
                <th>Quantity</th>
                <th>UnitPrice(INR)</th>
                <th>Total(INR)</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quote->items as $item)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td><a href="/products/{{ $item->product->id }}">{{ $item->product->name }}</a></td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->product->price, 2) }}</td>
                    <td>{{ number_format($item->total(), 2) }}</td>
                    <td>
                        <x-button btntype="danger" type="submit" form="delete-form-{{ $item->id }}">Remove</x-button>
                        <form id="delete-form-{{ $item->id }}"
                            action="/quotes/{{ $quote->id }}/items/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr class="no-border">
                <td></td>
                <td></td>
                <td></td>
                <td><strong>Total (INR) : </strong></td>
                <td>{{ number_format($quote->total(), 2) }}</td>
                <td></td>
            </tr>
            <tr class="no-border">
                <td></td>
                <td></td>
                <td></td>
                <td><strong>GST (18%) : </strong></td>
                <td>{{ number_format($quote->totalWithTax(), 2) }}</td>
                <td></td>
            </tr>
            <tr class="no-border">
                <td></td>
                <td></td>
                <td></td>
                <td><strong>Grand Total (INR) : </strong></td>
                <td><strong>{{ number_format($quote->grandTotal(), 2) }}</strong></td>
                <td></td>
            </tr>
        </tbody>
    </x-table>
    <x-button btntype="warning"><a href="/quotes/{{ $quote->id }}/pdf" target="_blank">Generate Quote
            PDF</a></x-button>
    <br><br>
    <div class="form-box">
        <form id="update-quote-form" method="POST" class="form quote-form" action="/quotes/{{ $quote->id }}/update">
            @csrf
            <div class="form-block">
                <x-form.field class="fb-200">
                    <select name="price_basis" id="price_basis">
                        @foreach ($priceBasis as $basis)
                            <option @if ($quote->priceBasis->description == $basis) selected @endif value="{{ $basis }}">
                                {{ $basis }}
                            </option>
                        @endforeach
                    </select>
                </x-form.field>
                <x-form.field class="fb-200">
                    <select name="delivery" id="delivery">
                        @foreach ($deliveries as $delivery)
                            <option @if ($quote->delivery->description == $delivery) selected @endif value="{{ $delivery }}">
                                {{ $delivery }}
                            </option>
                        @endforeach
                    </select>
                </x-form.field>
            </div>
        </form>
    </div>
@endSection
