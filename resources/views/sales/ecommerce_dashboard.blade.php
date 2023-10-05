@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Ecommerce Dashboard</h2>

<div class="flex flex-row justify-end">
    <div class="mr-2">
        <input type="text" class="rounded-sm text-xs h-7 font-semibold" name="search">
        <button class="bg-gray-800 text-gray-200 py-1 px-2 rounded-sm text-sm font-bold"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div ">
   
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold"><a href="{{route('ecommercecustomers')}}">Customers</a></button>
    </div>
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold"><a href="{{route('ecommerceproducts')}}">Products</a></button>
    </div>
    <div class="">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Sales</button>
    </div>
    
</div>
<div class="bg-white-900 text-gray-900 mt-1"> 
    <table class="w-full shadow-md bg-gray-400">
        <thead>
            <tr class="bg-gray-800 text-gray-200 h-8 md:h-10 text-xs">
                <th class="text-xs w-1/6 font-bold">TRACKING NUMBER</th>
                <th class="text-xs w-1/6 font-bold">CUSTOMERS NAME</th>
                <th class="text-xs w-1/6 font-bold">PAYMENT METHOD</th>
                <th class="text-xs w-1/6 font-bold">STATUS</th>
                <th class="text-xs w-1/6 font-bold">TOTAL AMOUNT</th>
                <th class="text-xs w-1/6 font-bold">DETAILS</th>
            </tr>
        </thead>    
       
        <tbody class="bg-gray-300">
            @foreach($ecommerceOrders as $ecommerceOrder)
            <tr class="h-10">   
                <td class="text-xs text-center border-b-2 font-bold">{{$ecommerceOrder -> tracking_number}}</td>
                <td class="text-xs text-center border-b-2 font-bold capitalize">{{$ecommerceOrder -> ecomCustomers -> name}}</td>
                <td class="text-xs text-center border-b-2 font-bold">{{$ecommerceOrder -> ecomCustomerPaymentTransactions -> payment_method}}</td>
                <td class="text-xs text-center border-b-2 font-bold">
                    @if($ecommerceOrder -> status == 9) Ongoing
                    @elseif($ecommerceOrder -> status == 3) Queued
                    @elseif($ecommerceOrder -> status == 8) Cancelled
                    @elseif($ecommerceOrder -> status == 4) Completed
                    @endif
                </td>
                <td class="text-xs text-center border-b-2 font-bold">₱{{number_format($ecommerceOrder -> ecomCustomerPaymentTransactions -> amount, 2)}}</td>
                <td class="text-xs text-center border-b-2 font-bold"><a href="{{route('ecommerceorderview', ['ecommerceOrder' => $ecommerceOrder -> id])}}"><i class="fa-solid fa-eye text-lg text-yellow-500 hover:text-yellow-600"></i></a></td>
            </tr>
              @endforeach
        </tbody>
    </table>
</div>
<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$ecommerceOrders" />
</div>


@endsection