@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Ongoing P.O Monitoring</h2>

<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-sm text-center w-1/6">PO NUMBER</th>
                <th class="text-sm text-center w-1/6">SUPPLIER</th>
                <th class="text-sm text-center w-1/6">DEL STATUS</th>
                <th class="text-sm text-center w-1/6">ACTION</th>
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-10">
               @foreach ($toReceivePurchaseOrders as $toReceivePurchaseOrder)
                   
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10">{{$toReceivePurchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 h-10">{{$toReceivePurchaseOrder  -> purchaseOrderSupplier -> supplier -> supplier_name}}</td>
                
                <td class="border-b-2 text-xs text-center w-1/6 h-10">
                    {{-- {{$toReceivePurchaseOrder -> del_status}} --}}
                    @if($toReceivePurchaseOrder -> del_status == 7)
                    Undelivered
                    @elseif($toReceivePurchaseOrder -> del_status == 6)
                    Partial
                    @endif
                </td>
                <td class="border-b-2 text-xs text-center w-1/6 hover:underline text-red-600 hover:font-bold"><a href="{{route('viewtobereceivepo', ['toReceivePurchaseOrder' => $toReceivePurchaseOrder])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$toReceivePurchaseOrders" />
</div>

@endsection