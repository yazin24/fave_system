@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold text-xl">View Purchase Order Details</h2>

<div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
    <div class="bg-gray-200 px-4 py-4">
    <h2 class="text-gray-800">P.O Number: <span class="text-red-400 font-bold">{{$purchase -> po_number}}</span></h2>
    <h2 class="text-gray-800">Supplier Name: <span class="text-red-400 font-bold">{{$purchase -> purchaseOrderSupplier -> supplier_name}}</span></h2>
    <h2 class="text-gray-800 capitalize">Status: <span class="text-red-700 font-bold">{{$purchase -> systemStatus -> status}}</span></h2>
    <br>

    <h2 class="text-gray-800">Requested By: <span class="text-yellow-600 font-bold">{{$purchase -> purchaseOrderCredentials -> requested_by}}</span></h2>
    <h2 class="text-gray-800">Prepared By: <span class="text-yellow-600 font-bold">{{$purchase -> purchaseOrderCredentials -> prepared_by}}</span></h2>
    <h2 class="text-gray-800">Approved By: <span class="text-yellow-600 font-bold">{{$purchase -> purchaseOrderCredentials -> approved_by}}</span></h2>
  
    <br>
    @foreach($purchase -> purchaseOrderItems as $index => $item)
    <h2 class="text-gray-800">
        Item {{$index + 1}}: 
        <span class="text-green-600 font-bold">{{$item -> item_name}}</span> <span class="text-red-600">||</span> Quantity: <span class="text-green-600 font-bold">{{$item -> quantity}} </span><span class="text-red-600">||</span> Price: <span class="text-green-600 font-bold">₱{{$item -> unit_price}} </span> <span class="text-red-600">||</span> Amount: <span class="text-green-600 font-bold">₱{{$item -> amount}}</span></h2>
    @endforeach
    <br>
    <h2>Total Amount: <span class="text-blue-500 font-bold">₱{{$totalAmount}}.00</span></h2>
    <br>
    </div>
    <div class="mt-4">
        @if($purchase -> systemStatus -> status === 'queued' || $purchase -> systemStatus -> status === 'disapproved')
        <button class="bg-teal-300 p-1 mt-2 rounded-md text-gray-200" disabled>Generate Receipt</button>
            @else
            <button class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 hover:bg-teal-600">
            <a href="{{route('generatereceipt', ['purchase' => $purchase -> id])}}" > Generate Receipt</a>
        </button>
        @endif
    </div>
</div>

@endsection