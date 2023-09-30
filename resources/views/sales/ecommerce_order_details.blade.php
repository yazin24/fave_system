@extends('sales.sales_home')

@section('sales-body')

<div class="mt-2">
  
    <div class="bg-gray-200 rounded-sm shadow-sm md:w-1/3 p-2">
        <div>
            <h2 class="font-bold md:text-xl text-gray-900 mt-2">Order Details</h2>
            <hr class="border border-b-1 border-gray-300 my-2">
        </div>
        <div>
            <h2>TRACKING NUMBER: {{$ecommerceOrder -> tracking_number}}</h2>
            <h2>FULL NAME: <span class="capitalize">{{$ecommerceOrder -> ecomCustomers -> name}}</span></h2>
            <h2>PHONE NUMBER: {{$ecommerceOrder -> ecomCustomers -> phone_number}}</h2>
            <h2>PAYMENT METHOD: {{$ecommerceOrder -> ecomCustomerPaymentTransactions -> payment_method}}</h2>
            <h2>STATUS: 
                @if($ecommerceOrder -> status == 8) Ongoing
                @elseif($ecommerceOrder -> status == 3) Queued
                @else Completed
                @endif
            </h2>
           

        </div>

        

    </div>

</div>


@endsection