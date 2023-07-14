@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full mx-auto">
   <h2 class="font-bold  text-xl mt-2">All Purchases</h2>
     <div class="my-4">      
            <form method="POST" action="{{ route('showpurchases') }}">
              @csrf 
                <label class="" for="date">Select Date:</label>
                <input type="date" name="date" class="shadow-lg text-sm">
                        
                        <div class="item-container">
                            <div class="flex gap-4">   
                                <div class="mt-2">
                                   <button type="submit" class="bg-green-400 hover:bg-blue-600 p-1 rounded-md shadow-lg text-gray-200 text-sm">Submit</button>
                                </div>   
            </form>              
                                    <div class="mt-2 mr-4">        
                                        <form method="GET" action="{{route('allpurchaseorder')}}">                           
                                           <button class="bg-green-400 hover:bg-blue-600 p-1 rounded-md shadow-lg text-gray-200 ml-1 text-sm">See All</button>
                                        </form>
                                    </div>    
                            </div>        
                        </div>           
    </div>
</div>


@if(isset($purchaseOrders))
<div class="bg-white-900 text-gray-900 mt-2">

    <div class="flex justify-end mr-1 mb-1">
        <button class="bg-blue-400 text-gray-100 text-xs rounded-md shadow-md hover:bg-blue-600 p-1" onclick="window.location.reload()">Refresh</button>
    </div>

    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96">
                <th class="text-center">PO_ID</th>
                <th class="text-center">PO_NUMBER</th>
                <th class="text-center">SUPPLIER</th>
                <th class="text-center">REQUESTED_BY</th>
                <th class="text-center">PREPARED_BY</th>
                <th class="text-center">APPROVED_BY</th>
                <th class="text-center">DATE_CREATED</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
            <tr class="h-10">
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> id}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> purchaseOrderCredentials -> requested_by}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> purchaseOrderCredentials -> prepared_by}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> purchaseOrderCredentials -> approved_by}}</td>
                <td class="border-b-2 text-sm text-center">{{$purchaseOrder -> created_at -> format('Y-m-d h:i:s A')}}</td>
                <td class="border-b-2 text-sm text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchase', ['purchase' => $purchaseOrder])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4 font-bold">
    {{$purchaseOrders -> links()}}
</div>
@endif

@endsection