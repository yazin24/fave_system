<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomers;
use App\Models\ProductSku;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function loading_animations()
    {
        return view('ecommerce.loading_animation');
    }

    public function home_page()
    {
        return view('ecommerce.home_page');
    }

    public function product_page()
    {
        $allProducts = ProductSku::all();

        $ecomCustomers = EcomCustomers::all();

        return view('ecommerce.product_page', ['allProducts' => $allProducts, 'ecomCustomers' => $ecomCustomers]);
    }

    public function service_page()
    {
        return view('ecommerce.services_page');
    }

    public function about_us_page()
    {
        return view('ecommerce.about_us_page');
    }

    public function login_page()
    {
        return view('ecommerce.login');
    }

    public function register_page()
    {
        return view('ecommerce.register');
    }
}
