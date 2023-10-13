<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EcomCustomerCart;
use App\Models\EcomCustomerOrders;
use App\Models\EcomCustomers;
use App\Models\ProductSku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class EcommerceFunctionsController extends Controller
{
    public function shopping_cart()
    {
        if(auth('customers') -> check()){

            $ecomCsutomerId = auth('customers') -> user() -> id;

            $allItemCart = EcomCustomerCart::where('ecom_cs_id', $ecomCsutomerId) -> get();

            $cartAllQuantity = $allItemCart -> sum('quantity');

            // if (request()->wantsJson()) {
            //     return response()->json(['cartAllQuantity' => $cartAllQuantity]);
            // }

            // session(['cartAllQuantity' => $cartAllQuantity]);
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

            $cartQuantity = EcomCustomerCart::where('ecom_cs_id', $ecomCustomers)->sum('quantity');

            // Store the cart quantity in the session
            session(['cartAllQuantity' => $cartQuantity]);

            
                    
        }else {

            return redirect() -> route('loginpage');

        }

        sleep(1.5);

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

        $paymentMethod = $request -> input('payment_method');

        $orderInfo = [

            'payment' => $paymentMethod,

        ];

        session(['orderInfo' => $orderInfo]);

        $generateNumber = function() {

            $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);

            while (EcomCustomerOrders::where('tracking_number', $generatedTrackingNumber) -> exists()){

                $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);
            }

            return $generatedTrackingNumber;

        };

        $trackingNumber = $generateNumber();

        if(empty($productOrders)){
            
            return redirect() -> back() -> with('error', 'Please check atleast one item to proceed.');
            
        }

        $newCustomerOrder = EcomCustomerOrders::create([

            'ecom_cs_id' => $customerId,
            'status' => 3,
            'shipping_address' => $customerOrderShippingAddress,
            'billing_address' => '',
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

        return redirect() -> route('orderdetailstoconfirm', ['orderId' => $orderId]);

    }

    public function order_details_to_confirm()
    {
        $customerId = auth('customers')->user()->id;

        $customerOrders = EcomCustomerOrders::with('ecomCustomerOrderItems.productSku')
        // ->where('id', $orderId)
        ->where('ecom_cs_id', $customerId)
        ->where('status', 3)
        ->get();

        $totalAmountOrder = 0; // Initialize the total amount

        foreach ($customerOrders as $order) {
            foreach ($order->ecomCustomerOrderItems as $orderItem) {
                // Calculate the total amount for each order item and add it to the total
                $totalAmountOrder += $orderItem->quantity * $orderItem->price;
            }
        }

        return view('ecommerce.order_details_to_confirm', ['customerOrders' => $customerOrders, 'totalAmountOrder' => $totalAmountOrder]);
    }

    public function confirm_order($orderId)
    {
        $toConfirmCustomerOrder = EcomCustomerOrders::findOrFail($orderId);

        $orderInfo = session('orderInfo');

        $totalAmount = 0;

        foreach ($toConfirmCustomerOrder->ecomCustomerOrderItems as $orderItem) {
            $totalAmount += $orderItem->quantity * $orderItem->price;
        }

        // $toConfirmCustomerOrder -> update([

        //     'status' => 3,

        // ]);

        $toConfirmCustomerOrder -> ecomCustomerPaymentTransactions() -> create([
            
            'order_id' => $toConfirmCustomerOrder -> id,
            'payment_method' => $orderInfo['payment'],
            'amount' => $totalAmount,
            'ref_number' => '',
            
        ]);

        $toConfirmCustomerOrder -> save();

        return redirect() -> route('generateqrcode', ['order' => $toConfirmCustomerOrder]);
    }

    public function delete_item_order($orderId)
    {
        $deleteItemOrder = EcomCustomerOrders::findOrFail($orderId);

        if($deleteItemOrder){

            $deleteItemOrder -> ecomCustomerOrderitems() -> delete();

            $deleteItemOrder -> delete();

        return redirect() -> route('orderdetailstoconfirm', ['orderId' => $orderId]);
    }

    }

    public function delete_item_in_shopping_cart($item)
    {
        $shoppingItem = EcomCustomerCart::findOrFail($item -> id);

        if(!$shoppingItem){

            return redirect() -> route('shoppingcart');
        }

        $shoppingItem -> delete();

        return redirect() -> route('shoppingcart');
    }

    public function cancel_order($orderId)
    {
        $toDeleteCustomerOrder = EcomCustomerOrders::findOrFail($orderId);

        if($toDeleteCustomerOrder){

            $toDeleteCustomerOrder -> ecomCustomerOrderItems() -> delete();

            $toDeleteCustomerOrder -> delete();

            return redirect() -> route('homepage');

        }else {

            return redirect() -> route('homepage');

        }
        
    }

    public function buy_now_order_details(ProductSku $productId)
    {

        return view('ecommerce.buy_now_order_details', ['productId' => $productId]);
    }

    public function buy_now_place_order_details(Request $request, ProductSku $productId)
    {
        $orderInfo = [

            'quantity' => $request -> input('quantity'),
            'shipping_address' => $request -> input('shipping_address'),
            'payment_method' => $request -> input('payment_method'),

        ];

        session(['orderInfo' => $orderInfo]);

        return view('ecommerce.buy_now_place_order_details', ['productId' => $productId, 'orderInfo' => $orderInfo]);
    }

    // public function buy_now_generate_qrcode(ProductSku $productId)
    // {
    //     $product = ProductSku::find($productId -> id);

    //     return view('ecommerce.generated_qr_code', ['productId' => $product]);
    // }

    public function order_success_message()
    {
        return view('ecommerce.order_success_message');
    }

    public function customer_confirm_order(Request $request, ProductSku $productId)
    {
        // $product = $request->input('productId');

       $orderInfo = session('orderInfo');

       $paymentMethod = $orderInfo['payment_method'];

       $generateNumber = function() {

        $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);

        while (EcomCustomerOrders::where('tracking_number', $generatedTrackingNumber) -> exists()){

            $generatedTrackingNumber = mt_rand(100000000000000, 999999999999999);
        }

        return $generatedTrackingNumber;

    };

    $trackingNumber = $generateNumber();

       if($paymentMethod === 'Cash On Delivery' || $paymentMethod === 'Gcash' || $paymentMethod === 'Maya'){

        $customerId = auth('customers') -> user() -> id;

        if($paymentMethod === 'Cash On Delivery'){
            $status = 9;
        }elseif($paymentMethod === 'Gcash' || $paymentMethod === 'Maya'){
            $status = 3;
        }

        $order = EcomCustomerOrders::create([

            'ecom_cs_id' => $customerId,
            'status' => $status,
            'shipping_address' => $orderInfo['shipping_address'],
            'billing_address' => '',
            'tracking_number' => $trackingNumber,

        ]);

        $order -> ecomCustomerOrderItems() -> create([

            'order_id' => $order -> id,
            'sku_id' => $productId -> id,
            'quantity' => $orderInfo['quantity'],
            'price' => $productId -> retail_price,

        ]);

        $totalAmount = $orderInfo['quantity'] * $productId -> retail_price;

        $order -> ecomCustomerPaymentTransactions() -> create([

            'order_id' => $order -> id,
            'payment_method' => $orderInfo['payment_method'],
            'amount' => $totalAmount,
            'ref_number' => '',

        ]);

        $order -> save();

       }//dugtong mo dito yung sa online payment na else statement

       return redirect() -> route('generateqrcode', ['order' => $order]);
    }

    public function show_all_customer_order()
    {
        $customerId = auth('customers')->user()->id;

        $customerOrders = EcomCustomerOrders::with('ecomCustomerOrderItems.productSku')
        // ->where('id', $orderId)
        ->where('ecom_cs_id', $customerId)
        ->get();

        $totalAmountOrder = 0; // Initialize the total amount

        foreach ($customerOrders as $order) {
            foreach ($order->ecomCustomerOrderItems as $orderItem) {
                // Calculate the total amount for each order item and add it to the total
                $totalAmountOrder += $orderItem->quantity * $orderItem->price;
            }
        }

        return view('ecommerce.all_customer_orders', ['customerOrders' => $customerOrders]);
    }

    // public function online_payment_success()
    // {
        
        

    // }

    public function merchant()
    {
        return view('ecommerce.merchant_temporary_message');
    }

    public function generate_qr_code(EcomCustomerOrders $order)
    {
        // $gcashData = "Recipient: 1234567890\nAmount: 100.00";

        // // Generate the QR code
        // $qrCode = QrCode::size(200)->generate($gcashData);
        
        
        return view('ecommerce.generated_qr_code', ['order' => $order]);
    }
}