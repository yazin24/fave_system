@extends('superadmin.superadmin_home')

@section('superadmin-body')


<h2 class="font-bold md:text-xl text-orange-600">Lazada Order Details</h2>

<div class="mt-2">
    {{-- <form method="POST" action="{{route('deliveredshopeestatus', ['shopeeSale' => $shopeeSale -> id])}}">
        @csrf
        @method('PUT') --}}
    <div class="bg-orange-600 rounded-sm p-1 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 
            <h2 class="font-bold text-sm mb-1">Order ID: {{$lazadaOrder -> order_id}}</h2>
            <h2 class="font-bold text-sm mb-1">Full Name: {{$lazadaOrder -> customers_name}}</h2>
            <h2 class="font-bold text-sm mb-1">Complete Address: {{$lazadaOrder -> customers_address}}</h2>
            <h2 class="font-bold text-sm mb-1 ">Status:
                @if($lazadaOrder -> status == 7)
                <select class="text-xs" name="status">
                    <option value="" selected disabled>Undelivered</option>
                    <option value=4>Delivered</option>
                    <option value=8>Cancelled</option>
                </select>
                @elseif($lazadaOrder -> status == 4)
                Completed
                @elseif($lazadaOrder -> status == 8)
                Cancelled
                @endif
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
                        @foreach($lazadaOrder -> shopeeOrderProducts as $index => $lazadaItem)
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
            <div class="flex flex-col gap-4 mt-2">
                @if($lazadaOrder -> status == 4)
                <h2 class="text-xs font-bold">Total Amount: ₱{{$totalOrderAmount}}</h2>
                <h2 class="text-xs font-bold">Total charges and fees: ₱{{$lazadaOrder -> charges_and_fees}}</h2>
                <h2 class="text-xs font-bold">Voucher: ₱{{$lazadaOrder -> voucher}}</h2>
                <h2 class="text-xs font-bold">Sales Amount: ₱{{$totalOrderAmount - $lazadaOrder -> charges_and_fees - $lazadaOrder -> voucher}}</h2>
           
            @endif
            </div>
           </div>

           <div class="mt-4 w-full">
            @if($lazadaOrder -> status == 7)
            <button type="submit" class="w-full text-gray-200 bg-orange-600 hover:bg-orange-700 font-bold text-sm p-1 rounded-md shadow-md">Update</button>
            @elseif($lazadaOrder -> status == 8)
            <h2 class="w-full text-gray-200 bg-red-600 hover:bg-red-700 font-bold text-sm p-1 rounded-md shadow-md text-center">Cancelled</h2>
            @elseif($lazadaOrder -> status == 4)
            <h2 class="w-full text-gray-200 bg-orange-600 hover:bg-orange-700 font-bold text-sm p-1 rounded-sm shadow-md text-center">Completed</h2>
            @endif
           </div>
    

        </div>

    </div>
    {{-- </form> --}}
</div>

@endsection