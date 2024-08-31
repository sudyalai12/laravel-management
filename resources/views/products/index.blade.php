@extends('layouts.app')
@section('content')
    {{-- {{ $products }} --}}
    <h1 class="heading">Products</h1>
    <x-button btntype="secondary"><a href="/products/create">Add new Product</a></x-button>
    <x-table>
        <thead>
            <tr>
                <th>ProdID</th>
                <th>Name</th>
                <th>Supplier</th>
                <th>Desc</th>
                <th>Price(INR)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td><a href="/products/{{ $product->id }}">{{ $product->id }}</a></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->supplier->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
@endSection
