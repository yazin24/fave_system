@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl">Manual Purchase Order Details</h2>

<div class="mt-4">

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

                <h2 class="text-xs text-gray-800 mb-4 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$manualPurchase -> po_number}}</span></h2>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Full Name: <span class="text-blue-600 font-bold">{{$manualPurchase -> customers_name}}</span></h2>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Contact Number: <span class="text-blue-600 font-bold">{{$manualPurchase -> contact_number}}</span></h2>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Address: <span class="text-blue-600 font-bold">{{$manualPurchase -> address}}</span></h2>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Purchase Type: <span class="text-blue-600 font-bold">{{$manualPurchase -> purchase_type}}</span></h2>
            
               <div class="bg-white-900 text-gray-900 mt-1"> 
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
                            @foreach($manualPurchase -> manualPurchaseOrderProducts as $index => $item)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold">{{$item -> productSku -> full_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$item -> productSku -> productVariants -> variant_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">
                                    @if($item -> productSku -> sku_size == 3785.41) 1 Gallon
                                    @elseif($item -> productSku -> sku_size == 1000) 1 Liter
                                    @else 500 ml
                                    @endif
                                </td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$item -> quantity}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">₱{{$item -> price}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">₱{{$item-> amount}}</td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                <div class="flex">
                    <div class="mt-12 text-xs">
                        @if($manualPurchase -> isApproved == 3)
                        <div class="flex gap-1">
                            <div>
                            <form method="POST" action="{{route('approvemanual', ['manualPurchase' => $manualPurchase -> id])}}">
                                @csrf
                                
                                <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold p-1 rounded-sm shadow-md text-gray-200"><i class="fa-regular fa-circle-check mr-0.5"></i>Approve</button>
                            </form>
                        </div> 
                        <div>
                            <form method="POST" action="{{route('disapprovemanual', ['manualPurchase' => $manualPurchase -> id])}}">
                                @csrf
                                
                                <button type="submit" class="bg-red-500 hover:bg-red-600 font-bold p-1 rounded-sm shadow-md text-gray-200"><i class="fa-regular fa-circle-xmark mr-0.5"></i>Disapprove</button>
                            </form>
                        </div>
                        </div>

                        @elseif($manualPurchase -> isApproved == 2)
                        <h2 class="bg-red-500 hover:bg-red-600 font-bold p-1 rounded-sm shadow-md text-gray-200"><i class="fa-regular fa-circle-xmark mr-0.5"></i>Disapproved</h2>
                        @elseif($manualPurchase -> isApproved == 1)

                        <button class="bg-teal-500 hover:bg-teal-600 font-bold p-1 rounded-sm shadow-md text-gray-200"><a href="{{route('manualreceipt', ['manualPurchase' => $manualPurchase])}}"><i class="fa-solid fa-print mr-0.5"></i>Generate Receipt</a></button>

                        @endif
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4">
                        <th><span class="text-xs">Total Amount</span>:</th>
                        <td><span class="text-xs text-red-600">₱{{$totalAmount}}</span></td>
                    </div>
                 </div>
         </div>

    </div>

</div>


@endsection