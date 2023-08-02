@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl mt-1">For Approval</h2>

<div class="mt-4">

    <div>
        <table class="w-full bg-gray-300">
            <thead>
                <tr class="bg-gray-900 text-gray-200 md:h-10">
                    
                    <th class="text-xs text-center w-1/5">PO NUMBER</th>
                    <th class="text-xs text-center w-1/5">SUPPLIER</th>
                    <th class="text-xs text-center w-1/5">REQUESTED BY</th>
                    <th class="text-xs text-center w-1/5">PREPARED BY</th>
                    <th class="text-xs text-center w-1/5">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queuePurchases as $queuePurchase) 
                <tr class="h-10">
                    <td class="border-b-2 text-xs text-center">{{$queuePurchase -> po_number}}</td>
                    <td class="border-b-2 text-xs text-center">{{$queuePurchase -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-xs text-center">{{$queuePurchase -> requested_by}}</td>
                    <td class="border-b-2 text-xs text-center">{{$queuePurchase -> prepared_by}}</td>
                    <td class="text-red-500 font-bold hover:underline cursor-pointer border-b-2 text-xs text-center"><a href="{{route('adminpurchaseorderapproval', ['queuePurchase' => $queuePurchase])}}">View</a></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection