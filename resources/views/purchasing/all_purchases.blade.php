@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full">
   <h2 class="font-bold md:text-xl mt-2">All Purchases</h2>

     <div class=" flex flex-row mt-4">   

        <div class="flex justify-center items-center mt-2">  
            <form method="POST" action="{{ route('showpurchases') }}">
              @csrf 
                    <label class="text-xs" for="date">Select Date:</label>
                    <input type="date" name="date" class="shadow-lg text-xs">
                    <button type="submit" class="bg-teal-400 hover:bg-teal-600 p-1 rounded-sm shadow-lg text-gray-200 text-xs ml-1">Submit</button>
                </form>
            </div>
                     <div class="flex justify-center items-center mt-1.5">  
                         <form method="GET" action="{{route('allpurchaseorder')}}">                           
                            <button class="bg-teal-400 hover:bg-teal-600 p-1 rounded-sm shadow-lg text-gray-200 ml-1 text-xs">See All</button>
                         </form>
                        </div>       
         </div>           



    @if(isset($purchaseOrders))
    <div class="bg-white-900 text-gray-900 mt-2">

    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-8 md:h-10">
                <th class="text-xs text-center">PO_ID</th>
                <th class="text-xs text-center">PO_NUMBER</th>
                <th class="text-xs text-center">SUPPLIER</th>
                <th class="text-xs text-center hidden md:table-cell">REQUESTED_BY</th>
                <th class="text-xs text-center hidden md:table-cell">PREPARED_BY</th>
                <th class="text-xs text-center hidden md:table-cell">APPROVED_BY</th>
                <th class="text-xs text-center">DATE_CREATED</th>
                <th class="text-xs text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseOrders as $purchaseOrder)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> id}}</td>
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> po_number}}</td>
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchaseOrder -> requested_by}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchaseOrder -> prepared_by}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchaseOrder -> approved_by}}</td>
                <td class="border-b-2 text-xs text-center">{{$purchaseOrder -> created_at -> format('Y-m-d h:i:s A')}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchase', ['purchase' => $purchaseOrder])}}">View</a></td>
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