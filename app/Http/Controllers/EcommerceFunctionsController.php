<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomers;
use App\Models\ProductSku;
use Illuminate\Http\Request;

class EcommerceFunctionsController extends Controller
{
    public function shopping_cart()
    {
        return view('ecommerce.shopping_cart');
    }

    public function add_to_cart(ProductSku $product)
    {
        if(auth('customers') -> check()){
            $ecomCustomers = auth('customers') ->user() -> id;
           
            $cartItem = $ecomCustomers -> ecomCustomerCart()
                    -> where('sku_id', $product -> id)
                    ->first();
                    
        }

        

        return redirect() -> back();
    }
}
