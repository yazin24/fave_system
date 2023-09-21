@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Customers List</h2>


<div class="flex flex-row justify-end">
    {{-- <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Customers</button>
    </div>
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Products</button>
    </div>
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Ongoing</button>
    </div ">
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Delivered</button>
    </div>
    <div class="">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Sales</button>
    </div> --}}
    
</div>
<div class="bg-white-900 text-gray-900 mt-1"> 
    <table class="w-full shadow-md bg-gray-400">
        <thead>
            <tr class="bg-gray-800 text-gray-200 h-8 md:h-10 text-xs">
                {{-- <th class="text-xs w-1/6 font-bold">ORDER ID</th> --}}
                <th class="text-xs w-1/6 font-bold">CUSTOMERS NAME</th>
                <th class="text-xs w-1/6 font-bold">PHONE NUMBER</th>
                <th class="text-xs w-1/6 font-bold">ADDRESS</th>
                {{-- <th class="text-xs w-1/6 font-bold">TOTAL AMOUNT</th> --}}
                <th class="text-xs w-1/6 font-bold">ACTION</th>
                
            </tr>
        </thead>    

        <tbody class="bg-gray-300">
            
            <tr class="h-10">   
                {{-- <td class="text-xs text-center border-b-2 font-bold"></td>
                <td class="text-xs text-center border-b-2 font-bold"></td> --}}
                <td class="text-xs text-center border-b-2 font-bold">
                   
                </td>
                <td class="text-xs text-center border-b-2 font-bold"></td>
                <td class="text-xs text-center border-b-2 font-bold"></td>
                <td class="text-xs text-center border-b-2 font-bold"><i class="fa-solid fa-eye text-lg text-yellow-500 hover:text-yellow-600"></i></td>
            </tr>
              
        </tbody>
    </table>
</div>


@endsection