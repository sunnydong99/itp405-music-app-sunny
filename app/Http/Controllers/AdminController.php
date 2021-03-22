<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;


class AdminController extends Controller
{
    public function index()
    {
        $maintenanceMode = Configuration::where('name', '=', 'maintenance-mode')->first();
        return view('admin.configuration', [
            'maintenance' => $maintenanceMode,
        ]);
    }

    public function update(Request $request)
    {
       $maintenanceUpdate = $request->has('maintenance') ? true : false;
       // dd($maintenanceUpdate);
       $config_maintenance = Configuration::where('name', '=', 'maintenance-mode')->first();
       $config_maintenance->value = $maintenanceUpdate;
       $config_maintenance->save();
       return redirect()
            ->route('admin.index')
            ->with('success', "Successfully updated system configurations");
    }
}
