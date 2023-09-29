@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold">
    <form method="POST" action="{{route('customerconfirmorder', ['productId' => $productId -> id])}}">
        @csrf
        <div class="bg-gray-100 w-3/4 md:w-1/2 rounded-sm shadow-md p-2 flex flex-col">
        <h2 class="mb-2">Place Order Details/Payment Intent</h2>
        <hr>
       <div class="flex flex-col">
            <img src="{{asset($productId -> image_path)}}" class="w-32">
            <h2>Variant: {{$productId -> productVariants -> variant_name}}</h2>
            <h2>Size: @if($productId -> sku_size == 3785.41) 1 Gallon
                @elseif($productId -> sku_size == 1000) 1 Liter
                @elseif($productId -> sku_size == 900) 900g
                @else 180g
                @endif
            </h2>
            <h2>Price: ₱{{number_format($productId -> retail_price,2)}}</h2>
           <h2>Quantity: {{ session('orderInfo.quantity') }}</h2>
           <h2>Shipping Address: {{session('orderInfo.shipping_address')}}</h2>
           <h2>Payment Method: {{session('orderInfo.payment_method')}}</h2>
        </div>

        <hr class="my-2">
      
        <div class="flex justify-between mx-2 mt-4">
          
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm"><i class="fa-regular fa-square-check fa-bounce mr-1"></i>Confirm Order</button>
            
        </div>
        
        </div
    </form> 
</div>


@endsection