@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Products Storage</h2>

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