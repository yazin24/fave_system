<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomerCart;
use App\Models\EcomCustomerOrders;
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

    public function place_order(Request $request)
    {   
       
    //    dd($request -> all());

       $customerId = auth('customers') -> user() -> id;

        $productOrders = $request -> input('order_products', []);

        $productIds = $request -> input('product_id', []);

        $productOrderQuantity = $request -> input('product_quantity', []);

        $productOrderPrice = $request -> input('product_price', []);

        // $productOrderTotalAmount = $productOrderQuantity * $productOrderPrice;

        $customerOrderShippingAddress = $request -> input('shipping_address');

        $customerOrderBillingAddress = $request -> input('billing_address');

        $generateNumber = function() {

            $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);

            while (EcomCustomerOrders::where('tracking_number', $generatedTrackingNumber) -> exists()){

                $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);
            }

            return $generatedTrackingNumber;

        };

        $trackingNumber = $generateNumber();

        $newCustomerOrder = EcomCustomerOrders::create([

            'ecom_cs_id' => $customerId,
            'status' => 3,
            'shipping_address' => $customerOrderShippingAddress,
            'billing_address' => $customerOrderBillingAddress,
            'tracking_number' => $trackingNumber,

        ]);

        foreach($productIds as $productId){
            
            if(in_array($productId, $productOrders)){
                $quantityProduct = $productOrderQuantity[$productId] ?? null;
                $priceProduct = $productOrderPrice[$productId] ?? null;

                if($productId && $quantityProduct && $priceProduct){
                    // $totaOrderAmount = $quantityProduct * $priceProduct;

                    $newCustomerOrder  -> ecomCustomerOrderItems() -> create([

                        'order_id' => $newCustomerOrder -> id,
                        'sku_id' => $productId,
                        'quantity' => $quantityProduct,
                        'price' => $priceProduct,

                    ]);
                }
            }
        }

        // $csId = auth('customers') -> user() -> id;

        // $customerOrders = EcomCustomerOrders::with('ecomCustomerOrderItems.productSku') -> where('ecom_cs_id', $csId) -> get();

        // $totalAmountOrder = 0; // Initialize the total amount

        // foreach ($customerOrders as $order) {
        //     foreach ($order->ecomCustomerOrderItems as $orderItem) {
        //         // Calculate the total amount for each order item and add it to the total
        //         $totalAmountOrder += $orderItem->quantity * $orderItem->price;
        //     }
        // }

        $orderId = $newCustomerOrder -> id;

        return view('ecommerce.order_details_to_confirm', ['orderId' => $orderId]);

    }

    public function order_details_to_confirm($orderId)
    {
        $customerOrder = EcomCustomerOrders::with('ecomCustomerOrderItems.productSku')
        ->where('id', $orderId)
        ->where('ecom_cs_id', auth('customers')->user()->id)
        ->firstOrFail();

        return view('ecommerce.order_details_to_confirm');
    }

}
