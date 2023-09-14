<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function sales_monitoring()
    {
        return view('superadmin.sales_monitoring');
    }

    public function purchasing_monitoring()
    {
        return view('superadmin.purchasing_monitoring');
    }

    public function receiving_monitoring()
    {
        return view('superadmin.receiving_monitoring');
    }

    public function suppliers_monitoring()
    {
        return view('superadmin.suppliers_monitoring');
    }

    public function products_monitoring()
    {
        return view('superadmin.products_monitoring');
    }

    public function raw_materials_monitoring()
    {
        return view('superadmin.raw_materials_monitoring');
    }

    public function manufacturing_storage_monitoring()
    {
        return view('superadmin.manufacturing_storage_monitoring');
    }

    public function agents_monitoring()
    {
        return view('superadmin.agents_monitoring');
    }

    public function agent_customer_monitoring()
    {
        return view('superadmin.agent_customer_monitoring');
    }
}
