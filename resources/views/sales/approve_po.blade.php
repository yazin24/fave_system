@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Orders (FOR APPROVAL)</h2>

<div class="mt-2 md:mt-4">
    {{-- <form method="POST" action="{{route('saveandreceivepo', ['id' => $toReceivePurchaseOrder -> id])}}"> --}}
        {{-- @csrf
        @method('PUT') --}}
    <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">

        <div class="bg-gray-200 px-4 py-4"> 
            <h2 class="flex justify-end text-gray-800 font-bold text-sm">Agent Name: {{$purchaseOrder -> agents -> agent_name}}</h2>
            <div class="flex flex-row">
                <div class="text-sm">
                     <h2 class="text-gray-800 font-bold">Store Name: {{$purchaseOrder -> customers -> store_name}}</h2>
                    <h2 class="text-gray-800 font-bold">Full Name: {{$purchaseOrder -> customers -> full_name}}</h2>
                    <h2 class="text-gray-800 font-bold">Contact Number: {{$purchaseOrder -> customers -> contact_number}}</h2>
                </div>
             </div>
               <div class="bg-white-900 text-gray-900 mt-4"> 
                    <table class="w-full shadow-md bg-gray-400">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10">
                                <th class="text-xs w-1/5 font-bold">Sku</th>
                                <th class="text-xs w-1/5 font-bold">Variant</th>
                                <th class="text-xs w-1/5 font-bold">Size</th>
                                <th class="text-xs w-1/5 font-bold">Price</th>
                            </tr>
                        </thead>    
                        <tbody class="bg-gray-300 w-auto">
                            @foreach($purchaseOrder -> customersPurchaseOrdersProducts as $index => $product)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold">{{$product -> full_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold"></td>
                                <td class="text-xs text-center border-b-2 font-bold"></td>
                                <td class="text-xs text-center border-b-2 font-bold"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
               <div class="flex flex-row text-sm justify-between">
                    <h2 class="text-gray-800 font-bold">Wholesale: <span class="text-green-600 font-bold"></span></h2>
                    <h2 class="text-gray-800 font-bold">Total Amount: <span class="text-green-600 font-bold"></span></h2>  
         </div>

         <div>
                
         </div>
    </form>

</div>

@endsection