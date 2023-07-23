@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold text-xl mt-2">Ongoing P.O Monitoring</h2>

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
               @foreach ($toReceivePurchaseOrders as $toReceivePurchaseOrder)
                   
                <td class="border-b-2 text-sm text-center w-1/6 capitalize h-10">{{$toReceivePurchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-sm text-center w-1/6 h-10">{{$toReceivePurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                
                <td class="border-b-2 text-sm text-center w-1/6 h-10">
                    @if($toReceivePurchaseOrder -> del_status == 0)
                    Undelivered
                    @else
                    Delivered
                    @endif
                </td>
                <td class="border-b-2 text-sm text-center w-1/6 hover:underline text-red-600 hover:font-bold"><a href="{{route('viewtobereceivepo', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection