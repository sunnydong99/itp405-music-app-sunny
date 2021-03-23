<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Invoice;
use App\Models\User;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Where gates are defined
        Gate::define('view-invoice', function (User $user, Invoice $invoice) {
            return ($user->email === $invoice->customer->email);
        });

        Gate::before(function (User $user) // gets called before any other methods
        {
            // Using this instead of one line because the return values here are true and null
            // Always write gates in longer form
            if ($user->isAdmin()){
                return true;
            }
        });
    }
}
