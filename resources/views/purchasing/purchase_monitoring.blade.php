@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold text-xl mt-2">Purchase Monitoring</h2>


<div class="mt-1">

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
    <div class="flex flex-row bg-gray-900 text-gray-200 p-4 w-1/4">
        <div class="mr-2 text-xl">Latest Delivery:</div>
        <div class="text-xl">12-14-23</div>
    </div>

    </div>

    <div class="bg-white-900 text-gray-900 mt-1">
        <table class="bg-gray-300 shadow-lg w-full">
            <thead class="">
                <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 h-12">
                    <th class="text-center">PO_NUMBER</th>
                    <th class="text-center">SUPPLIER</th>
                    <th class="text-center">REQUESTED_BY</th>
                    <th class="text-center">PREPARED_BY</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">PAYMENT STATUS</th>
                    <th class="text-center">DUE DATE</th>
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

                    <td class="border-b-2 text-sm text-center capitalize">
                    @if($purchase -> payment_status == 0)
                    <form method="POST" action="{{route('updatepaymentstatus', [ 'id' => $purchase -> id])}}">
                        @csrf
                        @method('POST')
                        {{-- <input type="hidden" name="paid_status" value="1"> --}}
                   <button type="submit" onclick="return confirm('Are you sure that this purchase order is paid?')">Unpaid</button>
                    </form>
                    </td>
                    @else
                    Paid
                    @endif
                    <td class="border-b-2 text-sm text-center 
                    @if($purchase->payment_status == 0)
                    @if($purchase->daysDiff < 0)
                        bg-red-500 text-white font-bold
                    @elseif($purchase->daysDiff <= 3)
                        bg-yellow-500 text-white font-bold
                    @endif
                    @endif
                    ">
                        {{date('Y-m-d', strtotime($purchase->purchaseOrderTerms->due_date))}}
                    </td>
                    <td class="border-b-2 text-sm text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchase', ['purchase' => $purchase])}}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
       
    </div>

</div>

@endsection