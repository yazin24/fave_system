<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function stock_monitoring(){
        return view('inventory.stock_monitoring');
    }

    public function add_item(){
        return view('inventory.add_item');
    }

    public function stocks(){
        return view('inventory.stocks');
    }

    public function supplier(){
        return view('inventory.supplier');
    }

    public function inventory_history(){
        return view('inventory.inventory_history');
    }

}
