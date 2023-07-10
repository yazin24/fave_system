@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">For Approval</h2>

<div class="mt-4">

    <h2>Approved? Disapproved?</h2>

    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4">
        <h2 class="text-gray-800">P.O Number: <span class="text-red-400 font-bold">{{$queuePurchase -> po_number}}</span></h2>
        <h2 class="text-gray-800">Supplier Name: <span class="text-red-400 font-bold">{{$queuePurchase -> purchaseOrderSupplier -> supplier_name}}</span></h2>
        <h2 class="text-gray-800">Status: <span class="text-red-700 font-bold capitalize">{{$queuePurchase -> systemStatus -> status}}</span></h2>
        <br>
    
        <h2 class="text-gray-800">Requested By: <span class="text-yellow-600 font-bold">{{$queuePurchase -> purchaseOrderCredentials -> requested_by}}</span></h2>
        <h2 class="text-gray-800">Prepared By: <span class="text-yellow-600 font-bold">{{$queuePurchase -> purchaseOrderCredentials -> prepared_by}}</span></h2>
        <h2 class="text-gray-800">Approved By: <span class="text-yellow-600 font-bold">{{$queuePurchase -> purchaseOrderCredentials -> approved_by}}</span></h2>
      
        <br>
        @foreach($queuePurchase -> purchaseOrderItems as $index => $item)
        <h2 class="text-gray-800">
            Item {{$index + 1}}: 
            <span class="text-green-600 font-bold">{{$item -> item_name}}</span> <span class="text-red-600">||</span> Quantity: <span class="text-green-600 font-bold">{{$item -> quantity}} </span><span class="text-red-600">||</span> Price: <span class="text-green-600 font-bold">₱{{$item -> unit_price}} </span> <span class="text-red-600">||</span> Amount: <span class="text-green-600 font-bold">₱{{$item -> amount}}</span></h2>
        @endforeach
        <br>
        <h2>Total Amount: <span class="text-blue-500 font-bold">₱{{$totalAmount}}.00</span></h2>
        <br>
        </div>
        <div class="mt-4 flex flex-row">

           <div>
            <form method="POST" action="{{route('adminapprovepurchase', ['id' => $queuePurchase -> id])}}">
                @csrf
                <button class="bg-blue-400 p-1 text-xs rounded-md text-gray-300 hover:bg-blue-600 mr-2">Approve</button>
            </form>
           </div>

           <div>
            <form method="POST" action="{{route('admindisapprovepurchase', ['id' => $queuePurchase -> id])}}">
                @csrf
                <button class="bg-red-400 text-xs p-1 rounded-md text-gray-300 hover:bg-red-600">Disapprove</button>
            </form>
           </div>

        </div>
    </div>

</div>


@endsection