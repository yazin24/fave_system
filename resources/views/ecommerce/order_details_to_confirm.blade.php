@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold">
    <div class="bg-gray-100 w-3/4 md:w-1/2 rounded-sm shadow-md p-2">
        <h2 class="mb-2">Order Details</h2>
        <hr>
        @foreach($customerOrders as $order)
        @foreach($order -> ecomCustomerOrderItems as $item)
        <div class="bg-white mt-1 flex flex-col">
            <div>
                <img src="{{asset($item -> productSku -> image_path)}}" alt="Image">
            </div>
            <div>
                <h2>Variant: {{$item -> productSku -> productVariants -> variant_name}}</h2>
                <h2>Size: {{$item -> productSku -> productVariants -> variant_name}}</h2>
                <h2>Quantity: {{$item -> quantity}}</h2>
                <h2>Price:₱{{$item -> price}}</h2>
                <h2>Amount:₱{{number_format($item -> price * $item -> quantity, 2)}}</h2>
            </div>
            @endforeach
          @endforeach
        </div>
        <hr class="my-2">
        <div class="flex justify-end">
            <h2>Total Amount:₱{{number_format($totalAmountOrder, 2)}}</h2>
        </div>


        <div class="flex justify-between mx-2 mt-4">
            <button class="bg-red-500 hover:bg-red-600 p-1 text-sm text-gray-100 rounded-sm"><i class="fa-regular fa-rectangle-xmark mr-1"></i>Cancel</button>
            <button class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm"><i class="fa-regular fa-square-check fa-bounce mr-1"></i>Confirm Order</button>
        </div>
        
    </div
</div>

@endsection