@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl text-blue-900">Lazada Order Details</h2>

<div class="mt-2">
    <form>
    <div class="bg-blue-900 rounded-md px-2 py-2 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 
            <h2 class="font-bold text-sm mb-1">Order Number: {{$lazadaSale -> order_number}}</h2>
            <h2 class="font-bold text-sm mb-1">Full Name: {{$lazadaSale -> customers_name}}</h2>
            <h2 class="font-bold text-sm mb-1">Complete Address: {{$lazadaSale -> customers_address}}</h2>
            <h2 class="font-bold text-sm mb-1">Status:
                <select class="text-xs">
                    <option value="" selected disabled>Change Status</option>
                    <option value=4>Delivered</option>
                    <option value=7>Undelivered</option>
                    <option value=8>Cancelled</option>
                </select>
            </h2>

            <div class="bg-white-900 text-gray-900 mt-4"> 
                <table class="w-full shadow-md bg-gray-400">
                    <thead>
                        <tr class="bg-blue-900 text-gray-200 h-8 md:h-10 text-xs">
                            <th class="text-xs w-1/6 font-bold">Sku</th>
                            <th class="text-xs w-1/6 font-bold">Variant</th>
                            <th class="text-xs w-1/6 font-bold">Size</th>
                            <th class="text-xs w-1/6 font-bold">Quantity</th>
                            <th class="text-xs w-1/6 font-bold">Price</th>
                            <th class="text-xs w-1/6 font-bold">Amount</th>
                            
                        </tr>
                    </thead>    
    
                    <tbody class="bg-gray-300">
                        @foreach($lazadaSale -> lazadaOrderProducts as $index => $lazadaItem)
                        <tr class="h-10">   
                            <td class="text-xs text-center border-b-2 font-bold">{{$lazadaItem -> productSku -> full_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$lazadaItem -> productSku -> productVariants -> variant_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">
                                @if($lazadaItem -> productSku -> sku_size == 3785.41) 1 Gallon
                                @elseif($lazadaItem -> productSku -> sku_size == 1000) 1 Liter
                                @else 500 ml
                                @endif
                            </td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$lazadaItem -> quantity}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$lazadaItem -> price}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$lazadaItem-> amount}}</td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
           </div>

           <div class="flex justify-end mt-2">
            <h2 class="text-xs font-bold">Total Amount: ₱{{$orderTotalAmount}}</h2>
           </div>

           <div class="mt-4 w-full">
            <button type="submit" class="w-full text-gray-200 bg-blue-900 hover:bg-blue-800 font-bold text-sm p-1 rounded-md shadow-md">Update</button>
           </div>
    

        </div>

    </div>
    </form>
</div>


@endsection