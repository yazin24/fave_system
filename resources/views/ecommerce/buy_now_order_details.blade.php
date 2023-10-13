@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-semibold text-xs md:text-lg">
    
    <div class="bg-gray-100 w-3/4 md:w-1/4 rounded-sm shadow-md p-2">
        <form method="POST" action="{{route('buynowplaceorderdetails', ['productId' => $productId])}}">
            @csrf
        <h2 class="mb-2">Order Details</h2>
        <hr>
       <div class="mt-4">


            <div class="flex flex-row gap-2">
                <div>
                    <img src="{{asset($productId -> image_path)}}" class="w-32">
                </div>
                <div class="mt-12 md:mt-4">
                    <h2>Variant: {{$productId -> productVariants -> variant_name}}</h2>
                    <h2>Size: @if($productId -> sku_size == 3785.41) 1 Gallon
                        @elseif($productId -> sku_size == 1000) 1 Liter
                        @elseif($productId -> sku_size == 900) 900g
                        @else 180g
                        @endif
                    </h2>
                    <h2>Price: ₱{{number_format($productId -> retail_price,2)}}</h2>
                    
                        <input type="number" name="quantity" placeholder="Enter Qty" class="h-6 text-xs mb-1 w-24 mt-1 rounded-sm" required>
                   
                </div>
          
            </div>


            <div class=" mt-4">

                @if(auth('customers') -> check())
                 <input type="number" name="phone_number" value="{{auth('customers') -> user() -> phone_number}}" class="h-8 text-xs mb-1 w-full rounded-sm" required>
                {{-- <input type="text" name="billing address" placeholder="billing" required> --}}
                @endif
                <input type="text" name="shipping address" placeholder="Shipping Address" class="h-8 text-xs mb-1 w-full rounded-sm" required>
                <select name="payment_method" class="h-8 text-xs w-full rounded-sm">
                    <option disabled selected>Choose Payment method</option>
                    <option value="Cash On Delivery">Cash On Delivery</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Maya">Maya</option>
                    <option value="Paypal">Paypal</option>
                    {{-- <option>Cash On Delivery</option>
                    <option>Cash On Delivery</option> --}}
                </select>
                
            </div>

    </div>

        <hr class="my-2">
      
        <div class="flex justify-between mx-2 mt-4">
{{--            
                <button type="submit" class="bg-red-500 hover:bg-red-600 p-1 text-sm text-gray-100 rounded-sm" onclick="return confirm('Are you sure you want to cancel?')"><i class="fa-regular fa-rectangle-xmark mr-1"></i>Cancel</button> --}}
            
          
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm"><i class="fa-regular fa-square-check fa-bounce mr-1"></i>Place Order</button>
            
        </div>
        </form>
    </div
   
</div>

@endsection