@extends('receiving.receiving_home')

@section('receiving-body')

<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full lg:w-1/2">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-sm text-center w-1/6">QUANTITY</th>
                <th class="text-sm text-center w-1/6">ACTION</th>
                <th class="text-sm text-center w-1/6">DATE</th>
               
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-10">
               {{-- @foreach ($storageSkus as $storageSku) --}}
                   
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10"></td>
                <td class="border-b-2 text-xs text-center w-1/6 h-10"></td>
                
                <td class="border-b-2 text-xs text-center w-1/6 h-10"></td>
            </tr>
            
        </tbody>
    </table>
</div>


@endsection