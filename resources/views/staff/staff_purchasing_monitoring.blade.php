@extends('staff.staff_home')

@section('staff-body')

    <h2 class="font-bold text-2xl">Staff</h2>

    <div>

        <div class="flex flex-row">
            <div>
                <form method="POST" action="{{route('staffshowspecificpurchase')}}">
                    @csrf
                 <input type="date" name="date">
                <button type="submit" class="bg-teal-400 text-gray-200 rounded-md p-1 ml-4 hover:bg-teal-600 shadow-md">Submit</button>
                </form>
            </div>
            <div class="flex items-center ml-4">
                <form method="GET" action="{{route('staffshowallpurchases')}}">
                    
                    <button class="bg-teal-400 p-1 text-gray-200 rounded-md hover:bg-teal-600 shadow-md">See All</button>
                </form>
            </div>
        </div>
        @if(isset($allPurchaseOrders))
         <div class="mt-8">
            <table class="bg-gray-300 shadow-md w-full">
                <thead>
                    <tr class="bg-gray-900 border-b-2 text-gray-300 w-96">
                        <th class="text-center">PO_NUMBER</th>
                        <th class="text-center">SUPPLIER_NAME</th>
                        <th class="text-center">REQUESTED_BY</th>
                        <th class="text-center">PREPARED_BY</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">CREATED_AT</th>
                        <th class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPurchaseOrders as $allPurchaseOrder)
                    <tr class="h-10">
                        <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> po_number}}</td>
                        <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                        <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> requested_by}}</td>
                        <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}</td>
                        <td class="border-b-2 text-sm text-center capitalize">{{$allPurchaseOrder -> systemStatus -> status}}</td>
                        <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> created_at}}</td>
                        <td class="border-b-2 text-sm text-center text-red-500 font-bold hover:underline"><a href="{{route('viewpurchase', ['purchase' => $allPurchaseOrder])}}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
         @endif
    </div>


@endsection