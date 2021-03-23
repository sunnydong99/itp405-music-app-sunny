<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Invoice;


class InvoicePolicy
{
    use HandlesAuthorization;
    // Typically 1 policy per model
    
    public function view(User $user, Invoice $invoice)
    {
        // can i view an invoice?
        return ($user->email === $invoice->customer->email);
    }
}
