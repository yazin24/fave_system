@extends('salesagent.agent_dashboard')

@section('sales_agent-functions')

<h2 class="font-bold text-sm"><span class="text-teal-500">{{$customer -> full_name}}</span> Stocks Monitoring</h2>


<div class="bg-gray-900 p-1 rounded-md md:w-1/3">
    <div class="bg-gray-200 rounded-sm p-1">
        <h2 class="font-bold text-sm">Store Name: {{$customer -> store_name}}</h2>
        <h2 class="font-bold text-sm">Contact Number: {{$customer -> contact_number}}</h2>
        <h2 class="font-bold text-sm">Address: {{$customer -> address}}</h2>
        
        <div class="bg-white-900 text-gray-900 mt-1"> 
            <table class="w-full shadow-md bg-gray-400">
                <thead>
                    <tr class="bg-gray-900 text-gray-200 h-10">
                        <th class="text-xs w-1/4 font-bold">Sku</th>
                        <th class="text-xs w-1/4 font-bold">Variant</th>
                        <th class="text-xs w-1/4 font-bold">Size</th>
                        <th class="text-xs w-1/4 font-bold">Quantity</th>
                        {{-- <th class="text-xs w-1/5 font-bold">Amount</th>
                         --}}
                    </tr>
                </thead>    

                <tbody class="bg-gray-300 w-auto">
                    @foreach($customer -> customersStocks as $sku)
                    <tr class="h-10">   

                        <td class="text-xs text-center border-b-2 font-bold">{{$sku -> productSku -> full_name}}</td>

                        <td class="text-xs text-center border-b-2 font-bold">{{$sku -> productSku -> productVariants -> variant_name}}</td>
                        <td class="text-xs text-center border-b-2 font-bold">
                            @if($sku -> productSku -> sku_size == 3785.41) 1 Gallon
                            @elseif($sku -> productSku ->sku_size == 1000) 1 Liter
                            @else 500 ml
                            @endif
                        </td>

                        <td class="text-xs text-center border-b-2 font-bold">{{$sku -> quantity}}</td>

                    </tr>
                    @endforeach    
                </tbody>
            </table>
       </div>
    </div>

</div>

@endsection