@extends('receiving.receiving_home')

@section('receiving-body')

<div class="flex flex-row justify-between">
    <div>
        <h2 class="font-bold md:text-xl mt-2">Products Storage</h2>
    </div>

    <div class="flex flex-row items-center mt-2">
        <div>
            <button class="bg-teal-500 p-1 text-xs rounded-md font-bold text-gray-200 shadow-md mr-1"><i class="fa-regular fa-square-plus mr-1"></i>Input</button>
        </div>
        <div>
            <button class="bg-teal-500 p-1 text-xs rounded-md font-bold text-gray-200 shadow-md"><i class="fa-regular fa-square-minus mr-1"></i>Output</button>
        </div>
    </div>
   

</div>


<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-sm text-center w-1/6">VARIANT</th>
                <th class="text-sm text-center w-1/6">SIZE</th>
                <th class="text-sm text-center w-1/6">QUANTITY/DRUMS</th>
                <th class="text-sm text-center w-1/6">ACTION</th>
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-10">
               {{-- @foreach ($toReceivePurchaseOrders as $toReceivePurchaseOrder) --}}
                   
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10"></td>
                <td class="border-b-2 text-xs text-center w-1/6 h-10"></td>
                
                <td class="border-b-2 text-xs text-center w-1/6 h-10">
                   
                </td>
                <td class="border-b-2 text-xs text-center w-1/6 hover:underline text-red-600 hover:font-bold"><a>View</a></td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>

@endsection