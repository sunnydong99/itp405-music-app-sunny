<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {   
        // 02/22: rewrite index() eloquent
        // $invoices = Invoice::all(); // Suffers from the N+1 problem
        $invoices = Invoice::with(['customer'])->get(); // eager loading


        // $invoices = DB::table('invoices')
        //     ->join('customers','invoices.customer_id', '=', 'customers.id')
        //     ->get([
        //         'invoices.id AS id',
        //         'invoice_date',
        //         'first_name',
        //         'last_name',
        //         'total',
        //     ]);

        // SELECT invoices.id AS id, invoice_date, first_name, last_name, total
        // FROM invoices
        // INNER JOIN customers ON invoices.customer_id = customers.id
        
        return view('invoice.index', [
            'invoices' => $invoices // passing data into the view
        ]);
    }

    public function show($id)
    {
        // dd($id); // dump and die
        // $invoice = DB::table('invoices')
        //     ->where('id','=',$id)
        //     ->first();
        // $invoiceItems = DB::table('invoice_items')
        //     ->where('invoice_id', '=', $id)
        //     ->join('tracks', 'invoice_items.track_id','=','tracks.id')
        //     ->join('albums', 'tracks.album_id','=','albums.id')
        //     ->join('artists','albums.artist_id','=','artists.id')
        //     ->get([
        //         'invoice_items.unit_price',
        //         'tracks.name AS track',
        //         'albums.title AS album',
        //         'artists.name AS artist',
        //     ]);

        $invoice = Invoice::with([
            'invoiceItems.track', // eager loading each relationship
            'invoiceItems.track.album',
            'invoiceItems.track.album.artist',
        ])->find($id);

        return view('invoice.show', [
            'invoice' => $invoice,
            // 'invoiceItems' => $invoiceItems, // don't need this, access through relationship
        ]);
    }
}
