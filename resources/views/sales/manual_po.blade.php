@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Manual PO</h2>


<div class="bg-white-900 text-gray-900 mt-1">
    <div class="flex justify-end">
        <form method="GET" action="{{route('manualpurchaseorder')}}">
            <button class="bg-teal-500 hover:bg-teal-600 font-bold text-gray-200 p-1 rounded-sm text-sm shadow-md mb-1"><a>Create New</a></button>
        </form>
        
    </div>
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-xs md:font-bold text-center">STORE NAME</th>
                <th class="text-xs text-center">FULL NAME</th>
                <th class="text-xs text-center">CP NUMBER</th>
                <th class="text-xs text-center">ACTION</th>
               
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($purchaseOrders as $purchaseOrder)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> customers -> store_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> customers -> full_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> customers -> contact_number}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewapprovepo', ['purchaseOrder' => $purchaseOrder])}}">View</a></td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>



@endsection