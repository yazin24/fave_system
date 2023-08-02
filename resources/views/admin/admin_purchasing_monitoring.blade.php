@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl">Purchasing Monitoring</h2>

<div class="flex flex-row mb-2 justify-between">
    <form method="GET" action="{{route('adminsearch')}}">
        <div class="flex flex-row mt-4">
            <input type="text" name="search" placeholder="Search here" class="text-xs">
            <div>
                <button type="submit" class="mt-2 bg-blue-400 hover:bg-blue-600 rounded-md p-1 text-gray-200 shadow-md ml-2 text-xs">Search</button>
            </div>
        </div>
    </form>
</div>

<div>
    @if(session()->has('success'))
        {{session('success')}}
    @endif
</div>

@if(isset($allPurchaseOrders))
    @if($allPurchaseOrders->count() > 0)
       
            <div class="">
                <table class="bg-gray-300 shadow-lg w-full">
                    <thead>
                        <tr class="md:h-8 bg-gray-900 border-b-2 text-gray-300 w-full">
                            <th class="text-sm text-center w-1/8">PO_NUMBER</th>
                            <th class="text-sm text-center w-1/8">SUPPLIER</th>
                            <th class="text-sm text-center w-1/8 hidden md:table-cell">REQUESTED_BY</th>
                            <th class="text-sm text-center w-1/8 hidden md:table-cell">PREPARED_BY</th>
                            <th class="text-sm text-center w-1/8 hidden md:table-cell">APPROVED_BY</th>
                            <th class="text-sm text-center w-1/8">STATUS</th>
                            <th class="text-sm text-center w-1/8">DATE</th>
                            <th class="text-sm text-center w-1/8">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allPurchaseOrders as $allPurchaseOrder)
                            <tr class="h-12">
                                <td class="border-b-2 text-xs text-center w-1/8">{{$allPurchaseOrder->po_number}} </td>
                                <td class="border-b-2 text-xs text-center w-1/8">{{$allPurchaseOrder->purchaseOrderSupplier->supplier_name}}</td>
                                <td class="border-b-2 text-xs text-center w-1/8 hidden hidden md:table-cell">{{$allPurchaseOrder->requested_by}}</td>
                                <td class="border-b-2 text-xs text-center w-1/8 hidden hidden md:table-cell">{{$allPurchaseOrder->prepared_by}}</td>
                                <td class="border-b-2 text-xs text-center w-1/8 hidden hidden md:table-cell">{{$allPurchaseOrder->approved_by}}</td>
                                <td class="border-b-2 text-xs text-center capitalize w-1/8">{{$allPurchaseOrder->systemStatus->status}}</td>
                                <td class="border-b-2 text-xs text-center w-1/8">{{$allPurchaseOrder->created_at->format('Y-m-d h:i:s A')}}</td>
                                <td class="border-b-2 text-xs text-center w-1/8">
                                    <div class="flex flex-row justify-center items-center">
                                        <div class="bg-yellow-500 p-1 mr-2 rounded-md shadow-md">
                                           
                                            <button><a href="{{route('adminviewpurchase', ['allPurchaseOrder' => $allPurchaseOrder])}}"><i class="fa-solid fa-eye"></i></a></button>
                                            
                                        </div>
                                        <div class="bg-red-500 p-1 rounded-md shadow-md">
                                            <form method="POST" action="{{route('adminpurchaseorderdelete', ['allPurchaseOrder' => $allPurchaseOrder, 'id' => $allPurchaseOrder->id])}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 font-bold">
                {{$allPurchaseOrders->links()}}
            </div>
        </div>
    @else
        {{-- <p>No Results Found</p> --}}
    @endif
@endif

@endsection