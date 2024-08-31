@extends('layouts.app')
@section('content')
    {{-- {{ $quotes }} --}}
    <h1 class="heading">Quotes</h1>
    <x-button btntype="secondary"><a href="/quotes/create">Add new Quote</a></x-button>
    <x-table>
        <thead>
            <tr>
                <th>QID</th>
                <th>ReferenceNo</th>
                <th>CustomerName</th>
                <th>ContactPersonName</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quotes as $quote)
                <tr>
                    <td><a href="/quotes/{{ $quote->id }}">{{ $quote->id }}</a></td>
                    <td>{{ $quote->reference }}</td>
                    <td><a href="/customers/{{ $quote->contact->address->customer->id }}">{{ $quote->contact->address->customer->name }}</a></td>
                    <td><a href="/contacts/{{ $quote->contact->id }}">{{ $quote->contact->name }}</a></td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
@endSection
