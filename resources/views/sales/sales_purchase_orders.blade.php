@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Orders</h2>


<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-xs md:font-bold text-center">STORE NAME</th>
                <th class="text-xs text-center">FULL NAME</th>
                <th class="text-xs text-center">CP NUMBER</th>
                <th class="text-xs text-center">DETAILS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allPurchaseOrders as $allPurchaseOrder)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$allPurchaseOrder -> customers -> store_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$allPurchaseOrder -> customers -> full_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$allPurchaseOrder -> customers -> contact_number}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchasedetails', ['purchaseOrder' => $allPurchaseOrder -> id])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



@endsection