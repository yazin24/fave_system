@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Agent Monitoring</h2>

<div class="mt-4">
   
    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-2 text-xs"> 
                <div>
                    <h2 class="text-gray-800 font-bold">Agent Name: <span class="text-blue-600 font-bold">{{$agent -> agent_name}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Area: <span class="text-red-700 font-bold capitalize">{{$agent -> areas -> area_name}}</span></h2>
                </div>
             </div>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">Address: <span class="text-blue-600 font-bold">{{$agent -> agent_address}}</span></h2>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">Number: <span class="text-blue-600 font-bold">{{$agent -> agent_number}}</span></h2>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">Email: <span class="text-blue-600 font-bold">{{$agent -> email_address}}</span></h2>
                <h2 class="text-gray-800 mb-2 font-bold text-xs">FB Messenger: <span class="text-blue-600 font-bold">{{$agent -> fb_messenger}}</span></h2>
            <hr class="border border-gray-900">
               <div class="bg-white-900 text-gray-900 mt-4"> 
                <h2 class="font-bold text-xs mb-1">Customer List</h2>
                    <table class="w-full shadow-md bg-gray-400 text-xs">
                        <thead>
                            <tr class="bg-gray-900 text-gray-200 h-10">
                                <th class="w-1/5 font-bold">Store Name</th>
                                <th class="w-1/5 font-bold">Full Name</th>
                                <th class="w-1/5 font-bold">Address</th>
                                <th class="w-1/5 font-bold">Number</th>
                                <th class="w-1/5 font-bold">Details</th>
                                
                            </tr>
                        </thead>    

                        <tbody class="bg-gray-300">
                            @foreach($agent -> customers as $agentCustomer)
                            <tr class="h-10">   
                                <td class="text-xs text-center border-b-2 font-bold">{{$agentCustomer -> store_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$agentCustomer -> full_name}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$agentCustomer -> address}}</td>
                                <td class="text-xs text-center border-b-2 font-bold">{{$agentCustomer -> contact_number}}</td>
                                <td class="text-xs text-center border-b-2 font-bold"><a href=""><i class="fa-solid fa-eye text-xl text-red-500 hover:text-red-600"></i></a></td>
                            </tr>
                            @endforeach    
                        </tbody>
                    </table>
               </div>

                {{-- <div class="flex flex-row">
                    <div class="mt-4 text-sm">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> requested_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> prepared_by}}</span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold">{{$allPurchaseOrder -> approved_by}}</span></h2>
                    </div> --}}

                    {{-- <div class="ml-auto mt-4 font-bold mr-4">
                        <th>Total Amount:</th>
                        <td><span class="text-red-600">₱{{$totalAmount}}.00</span></td>
                    </div> --}}
                 </div>
         </div>
{{-- 
         @if($allPurchaseOrder -> systemStatus -> status === 'queued')
         <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600 text-sm">
            Generate Receipt
        </button>
        @else
        <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600 text-sm">
            <a href="{{route('admingeneratereceipt', ['allPurchaseOrder' => $allPurchaseOrder -> id])}}" > Generate Receipt</a>
        </button>
        @endif --}}
    </div>
    
</div>

@endsection