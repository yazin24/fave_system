@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-semibold">
    
        <div class="bg-gray-100 w-3/4 md:w-1/4 rounded-sm shadow-md p-2 flex flex-col">
        <h2 class="mb-2 text-center">Order Confirmation</h2>
        <hr>
       <div class="flex flex-col mt-4 mx-2">
            <img src="{{asset($productId -> image_path)}}" class="w-32">
            <div class="mt-4">
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

               <h2 class="flex flex-row text-center">Payment Method:<span class="flex flex-row ml-1">

                @if(session('orderInfo.payment_method') === 'Gcash')<img src="{{asset('images/gcashlogo.png')}}" class="rounded-sm w-6">

                @elseif(session('orderInfo.payment_method') === 'Maya')<img src="{{asset('images/gcashlogo.png')}}" class="rounded-sm w-6">

                @elseif(session('orderInfo.payment_method') === 'Cash On Delivery')

                 Cash On Delivery

                @endif

                </span>

                </h2>

               <br>

               <hr>

               <br>

               @if(session('orderInfo.payment_method') === 'Cash On Delivery')
                
               @elseif(session('orderInfo.payment_method') === 'Paypal')

               <div class="">

                <div id="paypal-button-container"></div>

               </div>

               @endif
               
            </div>
           
        </div>

        <hr class="my-2">

        @if(session('orderInfo.payment_method') === 'Cash On Delivery' || 'Gcash' || 'Maya')

        <div class="flex justify-between mx-2 mt-4">

            <form method="POST" action="{{route('customerconfirmorder', ['productId' => $productId -> id])}}">
                @csrf

                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm"><i class="fa-regular 
                    fa-square-check mr-1"></i>Confirm Order</button>

            </form> 

        </div>

        @else

        @endif
        
        </div
   
</div>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$productId -> retail_price * session('orderInfo.quantity')}}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.capture().then(function(details) {
                window.location.href = "{{route('ordersuccessmessage')}}"
            });
        }
    }).render('#paypal-button-container');
</script>


@endsection