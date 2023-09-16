@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Order: {{$receivedPurchaseOrder -> po_number}}</h2>

<div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-xs mt-4">
    <div class="bg-gray-200 px-4 py-4"> 

        <div class="flex flex-row mb-4"> 
            <div>
                <h2 class="text-xs text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$receivedPurchaseOrder -> po_number}}</span></h2>
            </div>

            <div class="ml-auto">
                <h2 class="text-xs text-gray-800 font-bold">Status: <span class="text-blue-600 font-bold capitalize">{{$receivedPurchaseOrder -> systemStatus -> status}}</span></h2>
            </div>
            <div class="ml-auto">
                @if($receivedPurchaseOrder -> del_status == 4)
                <h2 class="text-xs text-gray-800 font-bold">Del Status: <span class="text-blue-600 font-bold capitalize">Complete</span></h2>
                @else <h2 class="text-xs text-gray-800 font-bold">Del Status: <span class="text-blue-600 font-bold capitalize">Incomplete</span></h2>
                @endif
            </div>
         </div>
            <h2 class="text-xs text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold">{{$receivedPurchaseOrder -> purchaseOrderSupplier -> supplier -> supplier_name}}</span></h2>
        
           <div class="bg-white-900 text-gray-900 mt-1"> 
                <table class="w-full shadow-md bg-gray-400">
                    <thead>
                        <tr class="bg-gray-900 text-gray-200 h-10">
                            <th class="text-xs w-1/5 font-bold">Item Name</th>
                            <th class="text-xs w-1/5 font-bold">Quantity</th>
                            <th class="text-xs w-1/5 font-bold">Unit</th>
                            <th class="text-xs w-1/5 font-bold">Price</th>
                            <th class="text-xs w-1/5 font-bold">Amount</th>
                        </tr>
                    </thead>    

                    <tbody class="bg-gray-300 w-auto">
                       @foreach($receivedPurchaseOrder -> purchaseOrderItems as $index => $item)
                        <tr class="h-10">   

                            <td class="text-xs text-center border-b-2 font-bold w-1/5">{{$item -> allItems -> item_name}}</td>

                            <td class="text-xs text-center border-b-2 font-bold w-1/5">{{$item -> quantity}}</td>

                            <td class="text-xs text-center border-b-2 font-bold w-1/5">{{$item -> allItems -> item_unit}}</td>

                            <td class="text-xs text-center border-b-2 font-bold w-1/5">{{$item -> unit_price}}</td>

                            <td class="text-xs text-center border-b-2 font-bold w-1/5">₱{{$item -> amount}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>

            <div class="flex flex-row">
                <div class="mt-4 text-xs">
                     <h2 class="text-gray-800 font-bold">Requested By: <span class="text-blue-600">{{$receivedPurchaseOrder -> requested_by}}</span><h2>
                    <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-blue-600">{{$receivedPurchaseOrder -> prepared_by}}</span></h2>
                    <h2 class="text-gray-800 font-bold">Approved By: <span class="text-blue-600">{{$receivedPurchaseOrder -> approved_by}}</span></h2>
                </div>

                <div class="text-xs ml-auto mt-4 font-bold mr-4">
                    <th>Total Amount:</th>
                    <td><span class="text-blue-600">₱{{$totalAmount}}</span></td>
                </div>
             </div>
     </div>


@endsection