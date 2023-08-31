@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Manual PO</h2>


<div class="bg-white-900 text-gray-900 mt-1">
    <div class="flex justify-end">
        <form method="GET" action="{{route('manualpurchaseorder')}}">
            <button class="bg-teal-500 hover:bg-teal-600 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md mb-1"><a>Create New</a></button>
        </form>
        
    </div>
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 md:h-12">
                <th class="text-xs md:font-bold text-center w-1/5">PO_NUMBER</th>
                <th class="text-xs md:font-bold text-center w-1/5">CUSTOMER'S NAME</th>
                <th class="text-xs text-center w-1/5">CP NUMBER</th>
                <th class="text-xs text-center w-1/5">ADDRESS</th>
                <th class="text-xs text-center w-1/5">DETAILS</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($allManualPurchaseOrders as $manualPurchase)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$manualPurchase ->  po_number}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase ->  customers_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase -> contact_number}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase -> address}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewmanualpo', ['manualPurchase' => $manualPurchase -> id])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4 font-bold">
    {{$allManualPurchaseOrders -> links()}}
</div>


@endsection