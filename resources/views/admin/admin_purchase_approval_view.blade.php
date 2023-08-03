@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">For Approval</h2>

<div class="mt-4">

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$queuePurchase -> po_number}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize">{{$queuePurchase -> systemStatus -> status}}</span></h2>
                </div>
             </div>
                <h2 class="text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold">{{$queuePurchase -> purchaseOrderSupplier -> supplier_name}}</span></h2>
            
               <div class="bg-white-900 text-gray-900 mt-1"> 
                    <table class="w-full shadow-md bg-gray-400">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10">
                                <th class="w-1/4 font-bold">Item Name</th>
                                <th class="w-1/4 font-bold">Quantity</th>
                                <th class="w-1/4 font-bold">Price</th>
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300">
                            @foreach($queuePurchase -> purchaseOrderItems as $index => $item)
                            <tr class="h-10">   
                                <td class="text-sm text-center border-b-2 font-bold">{{$item -> allItems -> item_name}}</td>
                                <td class="text-sm text-center border-b-2 font-bold">{{$item -> quantity}} {{$item -> allItems -> item_unit}}</td>
                                <td class="text-sm text-center border-b-2 font-bold">₱{{$item -> unit_price}}</td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row">
                    <div class="mt-4 text-sm">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold">{{$queuePurchase -> requested_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold">{{$queuePurchase -> prepared_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold">{{$queuePurchase -> approved_by}}</span></h2>
                    </div>

                    <div class="ml-auto mt-4 font-bold">
                        <th>Total Amount:</th>
                        <td><span class="text-red-600">₱{{$totalAmount}}.00</span></td>
                    </div>
                 </div>
                
         </div>
        
            <div class="mt-4 flex flex-row">

            <div>
                <form method="POST" action="{{route('adminapprovepurchase', ['id' => $queuePurchase -> id])}}">
                    @csrf
                    <button class="bg-blue-400 p-1 text-xs rounded-md text-gray-300 hover:bg-blue-700 mr-2 font-bold">Approve</button>
                </form>
            </div>

            <div>
                <form method="POST" action="{{route('admindisapprovepurchase', ['id' => $queuePurchase -> id])}}">
                    @csrf
                    <input type="hidden" name="poAmount" id="poAmount" value="{{$totalAmount}}">
                    <button class="bg-red-400 text-xs p-1 rounded-md text-gray-300 hover:bg-red-600 font-bold">Disapprove</button>
                </form>
            </div>

            </div>
    </div>

</div>


@endsection

