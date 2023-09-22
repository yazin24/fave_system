<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomerCart;
use App\Models\EcomCustomers;
use App\Models\ProductSku;
use Illuminate\Http\Request;

class EcommerceFunctionsController extends Controller
{
    public function shopping_cart()
    {
        if(auth('customers') -> check()){

            $ecomCsutomerId = auth('customers') -> user() -> id;

            $allItemCart = EcomCustomerCart::where('ecom_cs_id', $ecomCsutomerId)

                        ->get();
        }

        return view('ecommerce.shopping_cart', ['allItemCart' => $allItemCart]);
    }

    public function add_to_cart(ProductSku $product)
    {
        if(auth('customers') -> check()){

            $ecomCustomers = auth('customers') ->user() -> id;
           
            $cartItem = EcomCustomerCart::where('ecom_cs_id', $ecomCustomers)

                    -> where('sku_id', $product -> id)

                    ->first();

            if($cartItem){

                $cartItem -> increment('quantity');

            }else {

                EcomCustomerCart::create([
                    
                    'ecom_cs_id' => $ecomCustomers,
                    'sku_id' => $product -> id,
                    'quantity' => 1,
                    'price' => $product -> retail_price,
                    'isPurchase' => false,

                ]);

            }
                    
        }else {

            return redirect() -> route('loginpage');

        }

        return redirect() -> back();
    }
}
