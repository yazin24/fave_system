@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold text-xl">Received Purchase Order</h2>

<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 h-12">
                <th class="text-center w-1/6">PO NUMBER</th>
                <th class="text-center w-1/6">SUPPLIER</th>
                <th class="text-center w-1/6">DEL STATUS</th>
                <th class="text-center w-1/6">ACTION</th>
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-10">
                   
                <td class="border-b-2 text-sm text-center w-1/6 capitalize h-10">Sample</td>
                <td class="border-b-2 text-sm text-center w-1/6 h-10">Example</td>
                
                <td class="border-b-2 text-sm text-center w-1/6 h-10">
                 Yes
                </td>
                <td class="border-b-2 text-sm text-center w-1/6 hover:underline text-red-600 hover:font-bold"><a href="">View</a></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection