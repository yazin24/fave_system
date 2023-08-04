@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold md:text-xl">View Purchase Order Details</h2>

<div class="mt-4">

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-xs text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$purchase -> po_number}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-xs text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize">{{$purchase -> systemStatus -> status}}</span></h2>
                </div>
                <div class="ml-auto">
                    @if($purchase -> del_status == 0)
                    <h2 class="text-xs text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">No</span></h2>
                    @else <h2 class="text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">Yes</span></h2>
                    @endif
                </div>
             </div>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold">{{$purchase -> supplier_name}}</span></h2>
            
               <div class="bg-white-900 text-gray-900 mt-1"> 
                    <table class="w-full shadow-md bg-gray-400">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-8 md:h-10 text-xs">
                                <th class="text-xs w-1/4 font-bold">Item Name</th>
                                <th class="text-xs w-1/4 font-bold">Quantity</th>
                                <th class="text-xs w-1/4 font-bold">Price</th>
                                <th class="text-xs w-1/4 font-bold">Amount</th>
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300">
                            @foreach($purchase -> purchaseOrderItems as $index => $item)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold">{{$item ->allitems -> item_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$item -> quantity}} {{$item -> allItems -> item_unit}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">₱{{$item -> unit_price}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">₱{{$item -> amount}}</td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row">
                    <div class="mt-4 text-xs">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold">{{$purchase -> requested_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold">{{$purchase -> prepared_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold">{{$purchase -> approved_by}}</span></h2>
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4">
                        <th class="text-xs">Total Amount:</th>
                        <td><span class="text-xs text-red-600">₱{{$totalAmount}}.00</span></td>
                    </div>
                 </div>
         </div>

         @if($purchase -> systemStatus  -> status === 'queued')
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 text-xs" disabled>
           Generate Receipt
        </button>
        @else
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600 text-xs">
            <a href="{{route('generatereceipt', ['purchase' => $purchase -> id])}}" > Generate Receipt</a>
        </button>
        @endif
    </div>

</div>


@endsection