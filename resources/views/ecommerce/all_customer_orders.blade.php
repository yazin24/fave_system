@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold">
    <div class="bg-gray-100 w-3/4 md:w-1/2 rounded-sm shadow-md p-2 flex flex-col">
        <h2 class="mb-2">Order List</h2>
        <hr>
       <div class="flex flex-col">
            @foreach($customerOrders as $order)
            @foreach($order -> ecomCustomerOrderItems as $item)
            <div class="bg-white mt-1 flex flex-col md:flex-row md:justify-between md:align-center md:item-center p-2 md:p-4">

            <div>
                <img src="{{asset($item -> productSku -> image_path)}}" alt="Image" class="w-32 mr-4">
            </div>

            <div class="text-xs">
                <h2>Variant: {{$item -> productSku -> productVariants -> variant_name}}</h2>
                <h2>Size: @if($item -> productSku -> sku_size == 3785.41) 1 Gallon
                        @elseif($item -> productSku -> sku_size == 1000) 1 Liter
                        @elseif($item -> productSku -> sku_size == 900) 900g
                        @else 180g
                        @endif
                </h2>
                <h2>Quantity: {{$item -> quantity}}</h2>
                <h2>Price: ₱{{$item -> price}}</h2>
                <h2> Total Amount: ₱{{number_format($item -> price * $item -> quantity, 2)}}</h2>
            </div>
            <div>
                <h2 class="mt-4">Status: 
                    @if($order -> status == 9) <span class="text-red-600">Ongoing</span>
                    @elseif($order -> status == 3) <span class="text-yellow-600">Queued</span>
                    @else <span class="text-green-600">Completed</span>
                    @endif
                </h2>
            </div>
            </div>
            @endforeach
          @endforeach
        </div>

        <hr class="my-2">
        <div class="flex justify-end">
            {{-- <h2 class="text-red-500">Total Amount: ₱{{number_format($totalAmountOrder, 2)}}</h2> --}}
        </div>


        <div class="flex justify-between mx-2 mt-4">
            {{-- <form method="POST" action="{{route('cancelorder', ['orderId' => $order -> id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 p-1 text-sm text-gray-100 rounded-sm" onclick="return confirm('Are you sure you want to cancel?')"><i class="fa-regular fa-rectangle-xmark mr-1"></i>Cancel</button>
            </form>
            <form method="POST" action="{{route('confirmorder', ['orderId' => $order -> id])}}">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 text-sm text-gray-100 rounded-sm" ><i class="fa-regular fa-square-check fa-bounce mr-1"></i>Confirm Order</button>
            </form> --}}
           
        </div>
        
    </div
</div>

@endsection