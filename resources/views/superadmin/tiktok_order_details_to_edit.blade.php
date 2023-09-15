@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2 class="font-bold">Tiktok Order Details</h2>

<div class="mt-2">
    {{-- <form method="POST" action="{{route('deliveredtiktokstatus', ['tiktokSale' => $tiktokSale -> id])}}">
        @csrf
        @method('PUT') --}}
    <div class="bg-gray-900 rounded-sm p-1 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 
            <h2 class="font-bold text-sm mb-1">Order ID: {{$tiktokOrder -> order_id}}</h2>
            <h2 class="font-bold text-sm mb-1">Full Name: {{$tiktokOrder -> customers_name}}</h2>
            <h2 class="font-bold text-sm mb-1">Complete Address: {{$tiktokOrder -> customers_address}}</h2>
            <h2 class="font-bold text-sm mb-1 ">Status:
                @if($tiktokOrder -> status == 7)
                <select class="text-xs" name="status">
                    <option value="" selected disabled>Undelivered</option>
                    <option value=4>Delivered</option>
                    <option value=8>Cancelled</option>
                </select>
                @elseif($tiktokOrder -> status == 4)
                Completed
                @elseif($tiktokOrder -> status == 8)
                Cancelled
                @endif
            </h2>

            <div class="bg-white-900 text-gray-900 mt-4"> 
                <table class="w-full shadow-md bg-gray-400">
                    <thead>
                        <tr class="bg-gray-900 text-gray-200 h-8 md:h-10 text-xs">
                            <th class="text-xs w-1/6 font-bold">Sku</th>
                            <th class="text-xs w-1/6 font-bold">Variant</th>
                            <th class="text-xs w-1/6 font-bold">Size</th>
                            <th class="text-xs w-1/6 font-bold">Quantity</th>
                            <th class="text-xs w-1/6 font-bold">Price</th>
                            <th class="text-xs w-1/6 font-bold">Amount</th>
                        </tr>
                    </thead>    
    
                    <tbody class="bg-gray-300">
                        @foreach($tiktokOrder -> tiktokOrderProducts as $index => $tiktokItem)
                        <tr class="h-10">   
                            <td class="text-xs text-center border-b-2 font-bold">{{$tiktokItem -> productSku -> full_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$tiktokItem -> productSku -> productVariants -> variant_name}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">
                                @if($tiktokItem -> productSku -> sku_size == 3785.41) 1 Gallon
                                @elseif($tiktokItem -> productSku -> sku_size == 1000) 1 Liter
                                @else 500 ml
                                @endif
                            </td>
                            <td class="text-xs text-center border-b-2 font-bold">{{$tiktokItem -> quantity}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$tiktokItem -> price}}</td>
                            <td class="text-xs text-center border-b-2 font-bold">₱{{$tiktokItem-> amount}}</td>
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
           </div>

           <div class="flex justify-end mt-2">
            <div class="flex flex-col gap-4 mt-2">
                @if($tiktokOrder -> status == 4)
                <h2 class="text-xs font-bold">Total Amount: ₱{{$totalOrderAmount}}</h2>
                <h2 class="text-xs font-bold">Total charges and fees: ₱{{$tiktokOrder -> charges_and_fees}}</h2>
                <h2 class="text-xs font-bold">Voucher: ₱{{$tiktokOrder -> voucher}}</h2>
                <h2 class="text-xs font-bold">Sales Amount: ₱{{$totalOrderAmount - $tiktokOrder -> charges_and_fees - $tiktokOrder -> voucher}}</h2>
           
            @endif
            </div>
           </div>

           <div class="mt-4 w-full">
            @if($tiktokOrder -> status == 7)
            <button type="submit" class="w-full text-gray-200 bg-gray-900 hover:bg-gray-700 font-bold text-sm p-1 rounded-md shadow-md">Update</button>
            @elseif($tiktokOrder -> status == 8)
            <h2 class="w-full text-gray-200 bg-red-600 hover:bg-red-700 font-bold text-sm p-1 rounded-md shadow-md text-center">Cancelled</h2>
            @elseif($tiktokOrder -> status == 4)
            <h2 class="w-full text-gray-200 bg-gray-900 hover:bg-gray-700 font-bold text-sm p-1 rounded-md shadow-md text-center">Completed</h2>
            @endif
           </div>
    

        </div>

    </div>
    {{-- </form> --}}
</div>

@endsection