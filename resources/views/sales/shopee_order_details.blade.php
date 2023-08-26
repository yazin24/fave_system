@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl text-orange-600">Shopee Order Details</h2>

<div class="mt-2">
    <form method="POST" action="{{route('deliveredshopeestatus', ['shopeeSale' => $shopeeSale -> id])}}">
    <div class="bg-orange-600 rounded-md px-2 py-2 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 
            <h2 class="font-bold text-sm mb-1">Order ID: {{$shopeeSale -> order_id}}</h2>
            <h2 class="font-bold text-sm mb-1">Full Name: {{$shopeeSale -> customers_name}}</h2>
            <h2 class="font-bold text-sm mb-1">Complete Address: {{$shopeeSale -> customers_address}}</h2>
            <h2 class="font-bold text-sm mb-1">Status:
                <select class="text-xs" name="status">
                    <option value="" selected disabled>Change Status</option>
                    <option value=4>Delivered</option>
                    <option value=7>Undelivered</option>
                    <option value=8>Cancelled</option>
                </select>
            </h2>

            <div class="bg-white-900 text-gray-900 mt-4"> 
                <table class="w-full shadow-md bg-gray-400">
                    <thead>
                        <tr class="bg-orange-600 text-gray-200 h-8 md:h-10 text-xs">
                            <th class="text-xs w-1/6 font-bold">Sku</th>
                            <th class="text-xs w-1/6 font-bold">Variant</th>
                            <th class="text-xs w-1/6 font-bold">Size</th>
                            <th class="text-xs w-1/6 font-bold">Quantity</th>
                            <th class="text-xs w-1/6 font-bold">Price</th>
                            <th class="text-xs w-1/6 font-bold">Amount</th>
                            
                        </tr>
                    </thead>    
    
                    <tbody class="bg-gray-300">
                        @foreach($shopeeSale -> shopeeOrderProducts as $index => $shopeeItem)
                        <tr class="h-10">   
                            <td class="text-xs text-center border-b-2 font-bold">{{$shopeeItem -> productSku -> full_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$shopeeItem -> productSku -> productVariants -> variant_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">
                                @if($shopeeItem -> productSku -> sku_size == 3785.41) 1 Gallon
                                @elseif($shopeeItem -> productSku -> sku_size == 1000) 1 Liter
                                @else 500 ml
                                @endif
                            </td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$shopeeItem -> quantity}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$shopeeItem -> price}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$shopeeItem-> amount}}</td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
           </div>

           <div class="flex justify-end mt-2">
            <h2 class="text-xs font-bold">Total Amount: ₱{{$orderTotalAmount}}</h2>
           </div>

           <div class="mt-4 w-full">
            <button type="submit" class="w-full text-gray-200 bg-orange-600 hover:bg-orange-700 font-bold text-sm p-1 rounded-md shadow-md">Update</button>
           </div>
    

        </div>

    </div>
    </form>
</div>


@endsection