<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {   
        $this->authorize('viewAny', Invoice::class);
        // 02/22: rewrite index() eloquent
        // $invoices = Invoice::all(); // Suffers from the N+1 problem
        $invoices = Invoice::select('invoices.*')
            ->with(['customer']) // eager loading
            ->join('customers', 'invoices.customer_id', '=', 'customers.id')
            ->when(!Auth::user()->isAdmin(), function($query) { // conditionally adding a where clause to the query
                return $query->where('customers.email', '=', Auth::user()->email);
            })
            ->get();

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

        // Lecture 10
        // boolean - if they're equal, gate::denies will be false = no abort
        // if (Gate::denies('view-invoice', $invoice)){
        //     abort(403);
        // }
        // OR:
        // if (!Gate::allows(......))

        // OR: or !can
        // if (Auth::user()->cannot('view-invoice', $invoice)){
        //     abort(403);
        // }

        // OR: authorize class exists in controllers,
        // Gates are like callback functions like routes, policies group related authorizations like Controllers which group related routes
        // $this->authorize('view-invoice', $invoice);

        $this->authorize('view', $invoice);


        return view('invoice.show', [
            'invoice' => $invoice,
            // 'invoiceItems' => $invoiceItems, // don't need this, access through relationship
        ]);
    }
}
