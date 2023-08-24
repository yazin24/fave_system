@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Customer Details</h2>

<div class="mt-4">
   
    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-2 text-xs"> 
                <div>
                    <h2 class="text-gray-800 font-bold">Store Name: {{$agentCustomer -> store_name}}<span class="text-blue-600 font-bold"></span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Agent Name: {{$agent -> agent_name}}<span class="text-red-700 font-bold capitalize"></span></h2>
                </div>
             </div>
             <h2 class="text-gray-800 mb-2 font-bold text-xs">Full Name: {{$agentCustomer -> full_name}}<span class="text-blue-600 font-bold"></span></h2>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">Address: {{$agentCustomer -> address}}<span class="text-blue-600 font-bold"></span></h2>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">Number: {{$agentCustomer -> contact_number}}<span class="text-blue-600 font-bold"></span></h2>
        
            <hr class="border border-gray-900">
               <div class="bg-white-900 text-gray-900 mt-4"> 
                <h2 class="font-bold text-xs mb-1">Stocks Monitoring</h2>
                    <table class="w-full shadow-md bg-gray-400 text-xs">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10">
                                <th class="w-1/5 font-bold">Sku</th>
                                <th class="w-1/5 font-bold">Variant</th>
                                <th class="w-1/5 font-bold">Size</th>
                                <th class="w-1/5 font-bold">Quantity</th>
                               
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300">
                            @foreach($agentCustomer -> customersStocks as $stock)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold">{{$stock -> productSku -> full_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$stock -> productSku -> productVariants -> variant_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">
                                    @if($stock -> productSku -> sku_size == 3785.41) 1 Gallon
                                    @elseif($stock -> productSku -> sku_size == 1000) 1 Liter
                                    @else 500 ml
                                    @endif
                                </td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$stock -> quantity}}</td>
                            
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>
                 </div>
         </div>

    </div>
    
</div>

@endsection