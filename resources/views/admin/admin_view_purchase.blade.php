@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">Purchase Order Details</h2>

<div class="mt-4 text-xs font-bold">
   
    <div class="bg-gray-900 rounded-md p-2 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$allPurchaseOrder -> po_number}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize">{{$allPurchaseOrder -> systemStatus -> status}}</span></h2>
                </div>
             </div>
                <h2 class="text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold">{{$allPurchaseOrder -> purchaseOrderSupplier -> supplier -> supplier_name}}</span></h2>
            
               <div class="bg-white-900 text-gray-900 mt-1 text-xs"> 
                    <table class="w-full shadow-md bg-gray-400 text-xs">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10 text-xs">
                                <th class="w-1/4 font-bold">Item Name</th>
                                <th class="w-1/4 font-bold">Quantity</th>
                                <th class="w-1/4 font-bold">Price</th>
                                <th class="w-1/4 font-bold">Amount</th>
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300 text-xs">
                            @foreach($allPurchaseOrder -> purchaseOrderItems as $index => $item)
                            <tr class="h-10">   
                                <td class="text-sm text-center border-b-2 font-bold text-xs">{{$item -> allItems -> item_name}}</td>
                                <td class="text-sm text-center border-b-2 font-bold text-xs">{{$item -> quantity}} {{$item -> quantity_unit}}</td>
                                <td class="text-sm text-center border-b-2 font-bold text-xs">₱{{$item -> unit_price}}</td>
                                <td class="text-sm text-center border-b-2 font-bold text-xs">₱{{$item -> amount}}</td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row text-xs">
                    <div class="mt-4 text-xs">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> requested_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> prepared_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> approved_by}}</span></h2>
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4 text-xs">
                       <h2>Purchase Amount: ₱{{number_format($totalAmount, 2)}}</h2>
                       <h2>Delivery Charge: ₱{{number_format($allPurchaseOrder -> del_charge, 2)}}</h2> 
                       @if($allPurchaseOrder -> systemStatus -> status === 'queued')
                       <h2>Delivery Charge: ₱{{number_format($allPurchaseOrder -> total_amount, 2)}}</h2> 
                      @else
                      <h2 class="text-red-600">Total Amount: ₱{{number_format($allPurchaseOrder -> total_amount, 2)}}</h2> 
                      @endif
                    </div>
                 </div>
         </div>

         @if($allPurchaseOrder -> systemStatus -> status === 'queued')
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600 text-sm">
            Generate Receipt
        </button>
        @else
        <button class="bg-teal-500 p-1 mt-2 rounded-sm text-gray-200 hover:bg-teal-600 text-xs">
            <a href="{{route('admingeneratereceipt', ['allPurchaseOrder' => $allPurchaseOrder -> id])}}" > Generate Receipt</a>
        </button>
        @endif
    </div>
    
</div>

@endsection