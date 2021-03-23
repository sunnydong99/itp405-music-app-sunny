@extends('layouts.main')

{{-- code from github with blade --}}

@section('title', 'Invoices')

@section('content')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th colspan="2">Total</th>
            </tr>
        </thead>
        <tbody>
        <!-- blade syntax -->
            @foreach($invoices as $invoice) 
                <tr>
                    <td>
                        {{$invoice->id}}
                    </td>
                    <td>
                        {{$invoice->invoice_date}}
                    </td>
                    <td> 
                        {{-- updated with eloquent: need to point to song --}}
                        {{$invoice->customer->full_name}}
                    </td>
                    <td>
                        ${{$invoice->total}}
                    </td>
                    <td>
                        @can ('view', $invoice)
                            <a href="{{route('invoice.show', [ 'id' => $invoice->id ])}}">
                                Details
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection