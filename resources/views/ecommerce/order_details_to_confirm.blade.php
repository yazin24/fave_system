@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold">
    <div class="bg-gray-100 w-3/4 md:w-1/2 rounded-sm shadow-md p-2 flex flex-col">
        <h2 class="mb-2">Order Details</h2>
        <hr>
       <div class="flex flex-col">

        <div class="bg-white mt-1 flex flex-col">

            @foreach($customerOrders as $order)
            @foreach($order -> ecomCustomerOrderItems as $item)
            <div class="flex flex-row">

            <div>
                <img src="{{asset($item -> productSku -> image_path)}}" alt="Image" class="w-32">
            </div>

            <div class="text-xs ml-2">
                <h2>Variant: {{$item -> productSku -> productVariants -> variant_name}}</h2>
                <h2>Size: @if($item -> productSku -> sku_size == 3785.41) 1 Gallon
                        @elseif($item -> productSku -> sku_size == 1000) 1 Liter
                        @elseif($item -> productSku -> sku_size == 900) 900g
                        @else 180g
                        @endif
                </h2>
                <h2>Quantity: {{$item -> quantity}}</h2>
                <h2>Price: ₱{{$item -> price}}</h2>
                <h2>Amount: ₱{{number_format($item -> price * $item -> quantity, 2)}}</h2>
                <form method="POST" action="{{route('deleteitemorder', ['orderId' => $order -> id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline mt-2">Delete</button>
                </form>
                
            </div>
           
            </div>
            <br>
            <hr>
            <br>
            @endforeach
          @endforeach
        </div>

    </div>

        <hr class="my-2">
        <div class="flex flex-col justify-end text-xs">
            <h2 class="">Shipping Address: {{$order -> shipping_address}}</h2>
            <h2 class="">Payment Method: {{session('orderInfo.payment')}}</h2>
            <h2 class="text-red-500">Total Amount: ₱{{number_format($totalAmountOrder, 2)}}</h2>
        </div>


        <div class="flex justify-between mx-2 mt-4">
            <form method="POST" action="{{route('cancelorder', ['orderId' => $order -> id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 p-1 text-sm text-gray-100 rounded-sm" onclick="return confirm('Are you sure you want to cancel?')"><i class="fa-regular fa-rectangle-xmark mr-1"></i>Cancel</button>
            </form>
            <form method="POST" action="{{route('confirmorder', ['orderId' => $order -> id])}}">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm" ><i class="fa-regular fa-square-check fa-bounce mr-1"></i>Confirm Order</button>
            </form>
           
        </div>
        
    </div
</div>


@endsection