<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function received_po_monitoring()
    {
        return view('receiving.receiving_monitoring');
    }

    public function receive_po()
    {
        return view('receiving.receive_po');
    }
}
