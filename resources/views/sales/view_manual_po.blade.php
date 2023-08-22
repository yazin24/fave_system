@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl">View Purchase Order Details</h2>

<div class="mt-4">

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                {{-- <div>
                    <h2 class="text-xs text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold">{{$purchase -> po_number}}</span></h2>
                </div> --}}

                <div class="ml-auto">
                    <h2 class="text-xs text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize"></span></h2>
                </div>
                <div class="ml-auto">
                  
                </div>
             </div>
                <h2 class="text-xs text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold"></span></h2>
            
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
                            {{-- @foreach($purchase -> purchaseOrderItems as $index => $item) --}}
                            <tr class="h-10">   
                                <td class="text-xs md:text-sm text-center border-b-2 font-bold"></td>
                                <td class="text-xs md:text-sm text-center border-b-2 font-bold"></td>
                                <td class="text-xs md:text-sm text-center border-b-2 font-bold">₱</td>
                                <td class="text-xs md:text-sm text-center border-b-2 font-bold">₱</td>
                            </tr>
                            {{-- @endforeach     --}}
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row">
                    <div class="mt-4 text-xs">
                        
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4">
                        <th><span class="text-xs">Total Amount</span>:</th>
                        <td><span class="text-xs text-red-600">₱.00</span></td>
                    </div>
                 </div>
         </div>

         {{-- @if($purchase -> systemStatus  -> status === 'queued')
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 text-xs" disabled>
           Generate Receipt
        </button>
        @else
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600 text-xs">
            <a href="{{route('generatereceipt', ['purchase' => $purchase -> id])}}" > Generate Receipt</a>
        </button>
        @endif --}}
    </div>

</div>


@endsection