@extends('sales.sales_home')

@section('sales-body')

<div class="mt-2">
  
    <div class="bg-gray-200 rounded-sm shadow-sm md:w-1/3 p-2">
        <div>
            <h2 class="font-bold text-gray-900 mt-2">Order Details</h2>
            <hr class="border border-b-1 border-gray-300 my-2">
        </div>
        <div>
            <h2 class="mb-1">TRACKING NUMBER: {{$ecommerceOrder -> tracking_number}}</h2>
            <h2 class="mb-1">FULL NAME: <span class="capitalize">{{$ecommerceOrder -> ecomCustomers -> name}}</span></h2>
            <h2 class="mb-1">PHONE NUMBER: {{$ecommerceOrder -> ecomCustomers -> phone_number}}</h2>
            <h2 class="mb-1">PAYMENT METHOD: {{$ecommerceOrder -> ecomCustomerPaymentTransactions -> payment_method}}</h2>
            <h2 class="mb-1">STATUS: 
                @if($ecommerceOrder -> status == 9) Ongoing
                @elseif($ecommerceOrder -> status == 8) <span class="text-red-600">Cancelled</span>
                @elseif($ecommerceOrder -> status == 3) Queued
                @elseif($ecommerceOrder -> status == 4) <span class="text-teal-600">Completed</span>
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

        @if($ecommerceOrder -> status == 9)
        <div class="flex flex-col gap-1 my-2 w-full">
            <form method="POST" action="{{route('ecommerceordercomplete', ['ecommerceOrder' => $ecommerceOrder -> id])}}">
                @csrf
                @method('PUT')
                <button type="submit" class="text-xs font-bold text-gray-100 bg-teal-500 hover:bg-teal-600 p-1 rounded-sm w-full" onclick="return confirm('Update as Complete?')"><i class="fa-solid fa-circle-check mr-1"></i>Complete</button>
            </form>
           <form method="POST" action="{{route('ecommerceordercancel', ['ecommerceOrder' => $ecommerceOrder -> id])}}">
            @csrf
            @method('PUT')
            <button type="submit" class="text-xs font-bold text-gray-100 bg-red-500 hover:bg-red-600 p-1 rounded-sm w-full" onclick="return confirm('Update as Cancel?')"><i class="fa-solid fa-circle-xmark mr-1"></i>Cancel</button>
           </form>
        </div>
        @elseif($ecommerceOrder -> status == 4)
            <div class="flex flex-col gap-1 my-2 w-full">
                <button class="text-xs font-bold text-gray-100 bg-teal-500 hover:bg-teal-600 p-1 rounded-sm w-full"><i class="fa-solid fa-circle-check mr-1"></i>Completed</button>
                <button class="text-xs font-bold text-gray-100 bg-gray-200 p-1 rounded-sm w-full"><i class="fa-solid fa-circle-xmark mr-1"></i>Cancelled</button>
            </div>
        @elseif($ecommerceOrder -> status == 8)
        <div class="flex flex-col gap-1 my-2 w-full">
        <button class="text-xs font-bold text-gray-100 bg-gray-200 p-1 rounded-sm w-full"><i class="fa-solid fa-circle-check mr-1"></i>Completed</button>
            <button class="text-xs font-bold text-gray-100 bg-red-500 hover:bg-red-600 p-1 rounded-sm w-full"><i class="fa-solid fa-circle-xmark mr-1"></i>Cancelled</button>
          
        </div>
        @endif
    </div>

</div>


@endsection