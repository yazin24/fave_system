@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Customer Details</h2>

<div class="">
   
    <div class="bg-gray-900 rounded-sm p-1 max-w-screen-sm">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-2 text-xs"> 
                <div>
                    <h2 class="text-gray-800 font-bold">Name: <span class="text-blue-600 font-bold">{{$customer -> name}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Phone Number: <span class="text-red-700 font-bold capitalize">{{$customer -> phone_number}}</span></h2>
                </div>
             </div>
             <h2 class="text-gray-800 mb-2 font-bold text-xs">Email: <span class="text-blue-600 font-bold">{{$customer -> email}}</span></h2>

             <h2 class="text-gray-800 mt-2 font-bold">Customer Orders:</h2>
             <ul>
                @foreach ($customer->ecomCustomerOrders as $order)
                    <li>
                        Order ID: {{ $order->id }}
                        Status: {{ $order->status }}
                        Shipping Address: {{ $order->shipping_address }}
                        Billing Address: {{ $order->billing_address }}
                        Tracking Number: {{ $order->tracking_number }}
                        
                        <!-- Display order items for this order -->
                        <ul>
                            @foreach ($order->ecomCustomerOrderItems as $item)
                                <li>
                                    Item: {{ $item->item_name }}
                                    Quantity: {{ $item->quantity }}
                                    Price: {{ $item->price }}
                                </li>
                            @endforeach
                        </ul>
                        
                        <!-- Display payment transactions for this order -->
                        <h3>Payment Transactions:</h3>
                        @foreach ($order->ecomCustomerPaymentTransactions as $transaction)
                            {{-- <p>Transaction ID: {{ $transaction->id }}</p> --}}
                            {{-- <p>Amount: {{ $transaction->amount }}</p> --}}
                            <!-- Add more details about the payment transaction as needed -->
                        @endforeach
                        
                        <!-- Display sales for this order -->
                        @if ($order->ecomOrderSales)
                            <h3>Sales:</h3>
                            <p>Sale ID: {{ $order->ecomOrderSales->id }}</p>
                            <p>Sale Amount: {{ $order->ecomOrderSales->amount }}</p>
                            <!-- Add more details about the sale as needed -->
                        @endif
                    </li>
                @endforeach
             </ul>
               
         </div>

    </div>
    
</div>
</div>

@endsection