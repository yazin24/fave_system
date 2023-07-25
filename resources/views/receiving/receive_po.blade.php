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
                <th class="text-center w-1/6">ITEMS</th>
            </tr>
        </thead>
        <tbody>
           @foreach ( $receivedPurchaseOrders as $receivedPurchaseOrder )
               
            <tr class="h-10">
                   
                <td class="border-b-2 text-sm text-center w-1/6 capitalize h-10">{{$receivedPurchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-sm text-center w-1/6 h-10">{{$receivedPurchaseOrder ->purchaseOrderSupplier -> supplier_name}}</td>
                
                <td class="border-b-2 text-sm text-center w-1/6 h-10">
                @if($receivedPurchaseOrder -> del_status == 1)
                Delivered
                @else
                Undelivered
                @endif
                </td>
                <td class="border-b-2 text-sm text-center w-1/6">
                @foreach($receivedPurchaseOrder -> purchaseOrderItems as $index => $item)
                <span class="flex flex-row justify-center">
                <span>{{$item -> item_name}}</span>\<span>{{$item -> quantity}}{{$item -> quantity_unit}}</span>
                 </span>
                @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection