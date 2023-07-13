@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl mt-1">For Approval</h2>

<div class="mt-4">

    <div>
        <table class="w-full bg-gray-300">
            <thead>
                <tr class="bg-gray-900 text-gray-200 h-10">
                    
                    <th>PO NUMBER</th>
                    <th>SUPPLIER</th>
                    <th>REQUESTED BY</th>
                    <th>PREPARED BY</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($queuePurchases as $queuePurchase) 
                <tr class="h-10">
                    <td class="border-b-2 text-sm text-center">{{$queuePurchase -> po_number}}</td>
                    <td class="border-b-2 text-sm text-center">{{$queuePurchase -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-sm text-center">{{$queuePurchase -> purchaseOrderCredentials -> requested_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$queuePurchase -> purchaseOrderCredentials -> prepared_by}}</td>
                    <td class="text-red-500 font-bold hover:underline cursor-pointer border-b-2 text-sm text-center"><a href="{{route('adminpurchaseorderapproval', ['queuePurchase' => $queuePurchase])}}">View</a></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection