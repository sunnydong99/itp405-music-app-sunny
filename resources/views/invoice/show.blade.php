@extends('layouts.main')

{{-- code from github with blade --}}

@section('title')
    Invoice #{{$invoice->id}}

@section('content')
    {{-- <p>Invoice Total: {{$invoice->total}}</p> --}}
    <a href="{{route('invoice.index')}}" class="d-block mb-3">Back to Invoices</a>
    <p>Invoice Total: ${{$invoice->total}}</p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Track</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoiceItems as $invoiceItem)
                <tr>
                    <td>{{$invoiceItem->track}}</td>
                    <td>{{$invoiceItem->album}}</td>
                    <td>{{$invoiceItem->artist}}</td>
                    <td>${{$invoiceItem->unit_price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection