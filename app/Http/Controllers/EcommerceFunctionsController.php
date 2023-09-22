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
        $customerCart = EcomCustomerCart::all();

        return view('ecommerce.shopping_cart', ['customerCart' => $customerCart]);
    }

    public function add_to_cart(ProductSku $product)
    {
        if(auth('customers') -> check()){

            $ecomCustomers = auth('customers') ->user() -> id;
           
            $cartItem = $ecomCustomers -> ecomCustomerCart()
                    -> where('sku_id', $product -> id)
                    ->first();

            if($cartItem){
                $cartItem -> increment('quantity');
            }else {
                $ecomCustomers -> ecomCustomerCart() -> create([
                    'sku_id' => $product -> id,
                    'quantity' => 1,
                    'price' => $product -> retail_price,
                    'isPurchase' => false,
                ]);
            }
                    
        }else {
            return redirect() -> back();
        }

        

        return redirect() -> back();
    }
}
