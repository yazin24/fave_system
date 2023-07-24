@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold text-xl mt-2">View P.O</h2>

<div class="mt-4">

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$toReceivePurchaseOrder -> po_number}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize">{{$toReceivePurchaseOrder -> systemStatus -> status}}</span></h2>
                </div>
                <div class="ml-auto">
                    @if($toReceivePurchaseOrder -> del_status == 0)
                    <h2 class="text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">No</span></h2>
                    @else <h2 class="text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">Yes</span></h2>
                    @endif
                </div>
             </div>
                <h2 class="text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold">{{$toReceivePurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</span></h2>
            
               <div class="bg-white-900 text-gray-900 mt-1"> 
                    <table class="w-full shadow-md bg-gray-400">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10">
                                <th class="w-1/4 font-bold">Item Name</th>
                                <th class="w-1/4 font-bold">Quantity</th>
                                <th class="w-1/4 font-bold">Price</th>
                                <th class="w-1/4 font-bold">Amount</th>
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300 w-auto">
                            @foreach($toReceivePurchaseOrder -> purchaseOrderItems as $index => $item)
                            <tr class="h-10">   
                                <td class="text-sm text-center border-b-2 font-bold"><input class="text-xs items-center w-full" type="text" value="{{$item -> item_name}}"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="text" class="text-xs items-center w-full" value="{{$item -> quantity}} {{$item -> quantity_unit}}"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="number" class="text-xs items-center w-full" value="{{$item -> unit_price}}"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="number" class="text-xs items-center w-full" value="{{$item -> amount}}" readonly></td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row">
                    <div class="mt-4 text-sm">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold">{{$toReceivePurchaseOrder -> purchaseOrderCredentials -> requested_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold">{{$toReceivePurchaseOrder -> purchaseOrderCredentials -> prepared_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold">{{$toReceivePurchaseOrder -> purchaseOrderCredentials -> approved_by}}</span></h2>
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4">
                        <th>Total Amount:</th>
                        <td><span class="text-red-600">₱{{$totalAmount}}.00</span></td>
                    </div>
                 </div>
         </div>

         <div>
            <form method="POST">
                 <button class="bg-teal-400 hover:bg-teal-600 p-1 mt-2 rounded-sm text-gray-200 text-sm w-full font-bold">
                 Receive
                </button>
            </form>
         </div>
</div>


@endsection