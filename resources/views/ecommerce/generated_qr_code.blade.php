@extends('ecommerce.navbar')

@section('content')

    <div class="my-18 flex flex-col justify-center items-center">
      <h2 class="text-red-600 font-bold text-xl my-8">Your Order has been saved! Please<br> pay the amount of your order now.</h2>
      
        <div class=" mb-12 border border-gray-200 p-6 rounded-sm shadow-md py-8">
          <img src="{{asset('images/qrcode_gcash.jpg')}}">
          <h2 class="text-red-600 font-bold text-xs mb-1">Instructions: Please input the amount in gcash and<br> complete the transaction.</h2>
          <div>
            <h2>Total Amount: <span class="font-bold text-green-500">₱{{number_format($order -> ecomCustomerPaymentTransactions -> amount, 2)}}</span></h2>
          </div>
        </div>
       
    </div>

@endsection