@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold text-xl">Receive P.O</h2>

    <div class="ml-1 mt-2">
        <div class="flex items-center">
            <form method="GET" action="{{route('receivepoform')}}">
                @method('GET')
            <input type="text" name="search_po_number" class="text-xs">
                <buton class=" bg-teal-400 text-gray-200 hover:bg-teal-600 p-1 ml-1 rounded-md shadow-md"><a href="">Enter</a></buton>
            </form>
        </div>
    </div>

    @if(isset($toReceivePo))
    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-gray-800 font-bold">P.O Number: <span class="text-blue-600 font-bold"></span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Status: <span class="text-red-700 font-bold capitalize"></span></h2>
                </div>
                <div class="ml-auto">
                    {{-- @if($purchase -> del_status == 0) --}}
                    <h2 class="text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">No</span></h2>
                    {{-- @else <h2 class="text-gray-800 font-bold">Del Status: <span class="text-red-700 font-bold capitalize">Yes</span></h2>
                    @endif --}}
                </div>
             </div>
                <h2 class="text-gray-800 mb-4 font-bold">Supplier Name: <span class="text-blue-600 font-bold"></span></h2>
            
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

                        <tbody class="bg-gray-300">
                            {{-- @foreach($purchase -> purchaseOrderItems as $index => $item) --}}
                            <tr class="h-10">   
                                <td class="text-sm text-center border-b-2 font-bold mx-24"><input type="text" class="w-full text-xs"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="number" class="w-full text-xs"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="number" class="w-full text-xs"></td>
                                <td class="text-sm text-center border-b-2 font-bold"><input type="number" class="w-full text-xs"></td>
                            </tr>
                            {{-- @endforeach     --}}
                        </tbody>
                    </table>
               </div>

                <div class="flex flex-row">
                    <div class="mt-4 text-sm">
                         <h2 class="text-gray-800 font-bold">Requested By: <span class="text-green-600 font-bold"></span></h2>
                        <h2 class="text-gray-800 font-bold">Prepared By: <span class="text-green-600 font-bold"></span></h2>
                        <h2 class="text-gray-800 font-bold">Approved By: <span class="text-green-600 font-bold"></span></h2>
                    </div>

                    <div class="ml-auto mt-4 font-bold mr-4">
                        <th>Total Amount:</th>
                        <td><span class="text-red-600"></span></td>
                    </div>
                 </div>
         </div>

         {{-- @if($purchase -> systemStatus  -> status === 'queued') --}}
         <button class="bg-teal-400 hover:bg-teal-600 p-1 mt-2 rounded-sm text-gray-200 text-sm w-full font-bold" disabled>
           Receive
        </button>
        {{-- @else
        
        @endif --}}
    </div>
    @endif


@endsection