@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Orders (FOR APPROVAL)</h2>

<div class="mt-2 md:mt-4">
   
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
                                <th class="text-xs w-1/5 font-bold">Quantity</th>
                                <th class="text-xs w-1/5 font-bold">Price</th>
                            </tr>
                        </thead>    
                        <tbody class="bg-gray-300 w-auto">
                            @foreach($purchaseOrder -> productSku as $product)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold"><input name="full_name[{{$product -> id}}]" class="text-xs text-center w-full" type="text" value="{{$product -> full_name}}" readonly></td>
                                <td class="text-xs text-center border-b-2 font-bold"><input name="variant_name[{{$product -> id}}]" class="text-xs text-center w-full" type="text" value="{{$product -> productVariants -> variant_name}}" readonly></td>
                                <td class="text-xs text-center border-b-2 font-bold">
                                    <input name="sku_size[{{$product -> id}}]" class="text-xs text-center w-full" type="text" value=" @if($product -> sku_size ==3785.41) 1 Gallon @elseif($product -> sku_size == 1000) 1 Liter @else 500 ml @endif">
                                </td>
                                <td class="text-xs text-center border-b-2 font-bold"><input name="quantity[{{$product -> id}}]" class="text-xs text-center w-full" type="text" value="{{$product -> pivot -> quantity}}" readonly></td>
                                <td class="text-xs text-center border-b-2 font-bold"><input name="price[{{$product -> id}}]" class="text-xs text-center w-full" type="text" value="{{$product -> pivot -> price}}" read></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
               </div>
               <div class="flex flex-row text-sm justify-between mt-4">
                    <h2 class="text-gray-800 font-bold">Purchase type:
                        @if($product -> pivot -> isRetail == 1) 
                        <span class="text-green-600 font-bold">Retail</span>
                        @else <span class="text-green-600 font-bold">Wholesale</span>
                        @endif
                    </h2>
                    <h2 class="text-gray-800 font-bold">Total Amount: <span class="text-green-600 font-bold">₱{{$totalAmount}}.00</span></h2>  
         </div>

         <div class="flex flex-row gap-2 mt-8">
         <div>
            <form method="POST" action="{{route('approvepurchaseorder', ['purchaseOrder' => $purchaseOrder -> id])}}">
                <button class="font-bold text-xs bg-teal-500 hover:bg-teal-600 p-1 text-gray-200 rounded-md shadow-md"><i class="fa-regular fa-circle-check"></i> Approve</button>
            </form>
           
         </div>
         <div>
            <form method="POST" action="{{route('disapprovepurchaseorder', ['purchaseOrder' => $purchaseOrder -> id])}}">
                <button class="font-bold text-xs bg-red-500 hover:bg-red-600 p-1 text-gray-200 rounded-md shadow-md"><i class="fa-regular fa-circle-xmark"></i> Disapprove</button>
            </form>
           
         </div>
        </div>

</div>

@endsection