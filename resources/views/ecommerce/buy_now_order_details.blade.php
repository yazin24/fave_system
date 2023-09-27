@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold">
    <div class="bg-gray-100 w-3/4 md:w-1/2 rounded-sm shadow-md p-2 flex flex-col">
        <h2 class="mb-2">Order Details</h2>
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
            <input type="number" name="quantity" placeholder="quantity" required>
            <input type="text" name="shipping address" placeholder="shipping" required>
            @if(auth('customers') -> check())
            <input type="number" name="shipping address" value="{{auth('customers') -> user() -> phone_number}}" required>
            {{-- <input type="text" name="billing address" placeholder="billing" required> --}}
            @endif
        <div class="bg-white mt-1 flex flex-row">

          
        </div>

    </div>

        <hr class="my-2">
      
        <div class="flex justify-between mx-2 mt-4">
           
                <button type="submit" class="bg-red-500 hover:bg-red-600 p-1 text-sm text-gray-100 rounded-sm" onclick="return confirm('Are you sure you want to cancel?')"><i class="fa-regular fa-rectangle-xmark mr-1"></i>Cancel</button>
            
          
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm"><a href="{{route('buynowconfirmorderdetails', ['productId' => $productId -> id])}}"><i class="fa-regular fa-square-check fa-bounce mr-1"></i></a>Place Order</button>
            
        </div>
        
    </div
</div>

<x-modal name="example-modal">
    sdsds>
</x-modal>

@endsection