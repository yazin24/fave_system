@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl mt-2">Purchasing Monitoring</h2>

    <form method="GET" action="{{route('adminsearch')}}">
        <div class="flex flex-row mt-4">
            <div>
                <input type="text" name="search" placeholder="Search here">
            </div>
            <div>
                <button type="submit" class="mt-1 bg-green-400 hover:bg-blue-600 rounded-md p-1 text-gray-200 shadow-md ml-2">Search</button>
            </div>
        </div>
    </form>

<div class="flex justify-end mr-1">
    <button class="bg-green-400 text-gray-100 text-xs rounded-md shadow-md hover:bg-blue-600 p-1 mb-2" onclick="window.location.reload()">Refresh</button>
</div>

<div>
    @if(session() -> has('success'))
    {{session('success')}}
    @endif
</div>
@if(isset($allPurchaseOrders))
<div class="">
    <div>
        <table class="bg-gray-300 shadow-lg w-full">
            <thead>
                <tr class="bg-gray-900 border-b-1 text-gray-300 h-10">
                    <th class="text-center">PO_NUMBER</th>
                    <th class="text-center">SUPPLIER</th>
                    <th class="text-center">REQUESTED_BY</th>
                    <th class="text-center">PREPARED_BY</th>
                    <th class="text-center">APPROVED_BY</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">DATE_CREATED</th>
                    <th class="text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allPurchaseOrders as $allPurchaseOrder)
                <tr class="h-10">
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> po_number}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> requested_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> approved_by}}</td>
                    <td class="border-b-2 text-sm text-center capitalize">{{$allPurchaseOrder -> systemStatus -> status}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> created_at -> format('Y-m-d h:i:s A')}}</td>
                    <td class="border-b-2 text-sm text-center">

                        <div class="flex flex-row justify-center items-center">
                            <div class="bg-yellow-500 p-1 mr-2 rounded-md shadow-md"><button ><a href=""><i class="fa-solid fa-pen-to-square"></i></a></button></div>

                        <div class="bg-red-500 p-1 rounded-md shadow-md">
                            <form method="POST" action="{{route('adminpurchaseorderdelete', ['allPurchaseOrder' => $allPurchaseOrder, 'id' => $allPurchaseOrder -> id])}}">
                                @csrf
                                @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fa-solid fa-trash"></i>
                            </form>
                            </button>
                        </div>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 font-bold">
        {{$allPurchaseOrders -> links()}}
    </div>
    @endif
</div>


@endsection