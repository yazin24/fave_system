@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold text-xl">Purchase Monitoring</h2>

<div class="flex justify-end mr-1">
    <button class="bg-green-400 text-gray-100 text-xs rounded-md shadow-md hover:bg-blue-600 p-1" onclick="window.location.reload()">Refresh</button>
</div>

<div class="mt-4">

    <div class="flex flex-row w-full">

    <div class="flex flex-row bg-gray-900 text-gray-200 p-4 mr-2 w-1/4">
        <div class="mr-2 text-xl">Total Purchase: </div>
        <div class="text-xl"> {{$totalPurchase}}</div>
    </div>
    
    <div class="flex flex-row bg-gray-900 text-gray-200 p-4 mr-2 w-1/4">
        <div class="mr-2 text-xl">Total Amount:</div>
        <div class="text-xl">₱{{$totalAmount}}</div>
    </div>
    <div class="flex flex-row bg-gray-900 text-gray-200 p-4 mr-2 w-1/4">
        <div class="mr-2 text-xl">Queue:</div>
        <div class="text-xl">{{$purchaseQueue}}</div>
    </div>
    <div class="flex flex-row bg-gray-900 text-gray-200 p-4 mr-2 w-1/4">
        <div class="mr-2 text-xl">Latest Delivery:</div>
        <div class="text-xl">12-14-23</div>
    </div>

    </div>

    <div class="bg-white-900 text-gray-900 mt-4 ">
        <table class="bg-gray-300 shadow-lg w-full">
            <thead class="">
                <tr class="bg-gray-900 border-b-2 text-gray-300 w-96">
                    <th class="text-center">PO_NUMBER</th>
                    <th class="text-center">SUPPLIER</th>
                    <th class="text-center">REQUESTED_BY</th>
                    <th class="text-center">PREPARED_BY</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">DATE_CREATED</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="h-10">
                    <td class="border-b-2 text-sm text-center">{{$purchase -> po_number}}</td>
                    <td class="border-b-2 text-sm text-center">{{$purchase -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-sm text-center">{{$purchase -> purchaseOrderCredentials -> requested_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$purchase -> purchaseOrderCredentials -> prepared_by}}</td>
                    <td class="border-b-2 text-sm text-center capitalize">{{$purchase -> systemStatus -> status}}</td>
                    <td class="border-b-2 text-sm text-center">{{$purchase -> created_at -> format('Y-m-d h:i:s A')}}</td>
                    <td class="border-b-2 text-sm text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchase', ['purchase' => $purchase])}}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        {{-- <h2>lorem1000</h2> --}}
    </div>

</div>

@endsection