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
            
                @foreach ($customer->ecomCustomerOrders as $order)
                    <h2>{{$order -> tracking_number}}</h2>
                    <h2>{{$order -> shipping_address}}</h2>
                    <h2>@if($order -> status == 9)Ongoing

                        @elseif($order -> status == 4)Complete

                        @elseif($order -> status == 8) Cancelled

                        @else Queued

                        @endif</h2>
                        @foreach($order -> ecomCustomerOrderItems as $item)
                        <h2>{{$item -> productSku -> productVariants -> variant_name}}</h2>
                        @endforeach
                    <hr class="bg-gray-900 h-2">
                @endforeach
             
               
         </div>

    </div>
    
</div>
</div>

@endsection