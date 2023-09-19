<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function home_page()
    {
        return view('ecommerce.home_page');
    }

    public function product_page()
    {
        return view('ecommerce.product_page');
    }

    public function service_page()
    {
        return view('ecommerce.services_page');
    }

    public function about_us_page()
    {
        return view('ecommerce.about_us_page');
    }
}
