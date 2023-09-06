@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl">Received Purchase Order</h2>

<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-10">
                <th class="text-xs text-center w-1/6">PO NUMBER</th>
                <th class="text-xs text-center w-1/6">SUPPLIER</th>
                <th class="text-xs text-center w-1/6">DEL STATUS</th>
                <th class="text-xs text-center w-1/6">ITEMS</th>
            </tr>
        </thead>
        <tbody>
           @foreach ( $receivedPurchaseOrders as $receivedPurchaseOrder )
               
            <tr class="md:h-10">
                   
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-6 md:h-10">{{$receivedPurchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 h-6 md:h-10">{{$receivedPurchaseOrder ->purchaseOrderSupplier -> supplier ->  supplier_name}}</td>
                
                <td class="border-b-2 text-xs text-center w-1/6 h-6 md:h-10">
                @if($receivedPurchaseOrder -> del_status == 4)
                Complete
                @else
                Incomplete
                @endif
                </td>
                <td class="border-b-2 text-xs text-center w-1/6 text-red-500 hover:underline hover:font-bold">
                    <a href="{{route('viewreceived', ['receivedPurchaseOrder' => $receivedPurchaseOrder -> id])}}">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$receivedPurchaseOrders" />
</div>

@endsection