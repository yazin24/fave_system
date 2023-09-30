@extends('sales.sales_home')

@section('sales-body')

<div class="mt-2">
  
    <div class="bg-gray-200 rounded-sm shadow-sm md:w-1/3 p-2">
        <div>
            <h2 class="font-bold md:text-xl text-gray-900 mt-2">Order Details</h2>
            <hr class="border border-b-1 border-gray-300 my-2">
        </div>
        <div>
            <h2 class="mb-1">TRACKING NUMBER: {{$ecommerceOrder -> tracking_number}}</h2>
            <h2 class="mb-1">FULL NAME: <span class="capitalize">{{$ecommerceOrder -> ecomCustomers -> name}}</span></h2>
            <h2 class="mb-1">PHONE NUMBER: {{$ecommerceOrder -> ecomCustomers -> phone_number}}</h2>
            {{-- <h2 class="mb-1">PAYMENT METHOD: {{$ecommerceOrder -> ecomCustomerPaymentTransactions -> payment_method}}</h2> --}}
            <h2 class="mb-1">STATUS: 
                @if($ecommerceOrder -> status == 8) Ongoing
                @elseif($ecommerceOrder -> status == 3) Queued
                @else Completed
                @endif
            </h2>
        </div>
        <div>
            <table class="w-full shadow-md bg-gray-400">
                <thead>
                    <tr class="bg-violet-700 text-gray-200 h-8 md:h-10 text-xs">
                        <th class="text-xs w-1/6 font-bold">Sku</th>
                        <th class="text-xs w-1/6 font-bold">Variant</th>
                        <th class="text-xs w-1/6 font-bold">Size</th>
                        <th class="text-xs w-1/6 font-bold">Quantity</th>
                        <th class="text-xs w-1/6 font-bold">Price</th>
                        <th class="text-xs w-1/6 font-bold">Amount</th>
                    </tr>
                </thead>    

                <tbody class="bg-gray-300">
                    @foreach($ecommerceOrder -> ecomCustomerOrderItems as $orderItems)
                    <tr class="h-10">   
                        <td class="text-xs text-center border-b-2 font-bold">{{$orderItems -> productSku -> full_name}}</td>
                        <td class="text-xs text-center border-b-2 font-bold">{{$orderItems -> productSku -> productVariants -> variant_name}}</td>
                        <td class="text-xs text-center border-b-2 font-bold">
                            @if($orderItems -> productSku -> sku_size == 3785.41) 1 Gallon
                            @elseif($orderItems -> productSku -> sku_size == 1000) 1 Liter
                            @elseif($orderItems -> productSku -> sku_size == 900) 900g
                            @elseif($orderItems -> productSku -> sku_size == 180) 180g
                            @endif
                        </td>
                        <td class="text-xs text-center border-b-2 font-bold">{{$orderItems -> quantity}}</td>
                        <td class="text-xs text-center border-b-2 font-bold">₱{{$orderItems -> price}}</td>
                        <td class="text-xs text-center border-b-2 font-bold">₱{{number_format($orderItems-> quantity * $orderItems -> price,2)}}</td>
                    </tr>
                    @endforeach    
                </tbody>
            </table>
        </div>

        

    </div>

</div>


bonjinggg ako 1233333


@endsection