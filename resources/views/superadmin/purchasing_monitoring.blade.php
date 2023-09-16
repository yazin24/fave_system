@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Monitoring</h2>


<div class="mt-1 font-bold">

    <div class="flex flex-row w-full">

        
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-sm">Purchase: </div>
        <div class="text-xs md:text-sm"> {{$totalPurchase}}</div>
    </div>


    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-sm">Total:</div>
        <div class="text-xs md:text-sm">₱{{ $totalAmount % 1 === 0 ? number_format($totalAmount, 0) : number_format($totalAmount, 2) }}</div>
    </div>
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-sm">Queue:</div>
        <div class="text-xs md:text-sm">{{$purchaseQueue}}</div>
    </div>
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 w-1/4">
        <div class="mr-2 text-xs md:text-sm">Undelivered:</div>
        <div class="text-xs md:text-sm">{{$undeliveredPurchase}}</div>
    </div>

    </div>

    <div class="bg-white-900 text-gray-900 mt-1">
        <table class="bg-gray-300 shadow-lg w-full">
            <thead class="">
                <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                    <th class="text-xs md:font-bold text-center">PO_NUMBER</th>
                    <th class="text-xs text-center">SUPPLIER</th>
                    <th class="text-xs text-center hidden md:table-cell">REQUESTED_BY</th>
                    <th class="text-xs text-center hidden md:table-cell">PREPARED_BY</th>
                    <th class="text-xs text-center">STATUS</th>
                    <th class="text-xs text-center">PAYMENT STATUS</th>
                    <th class="text-xs text-center">DUE DATE</th>
                    <th class="text-xs text-center">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="h-10">
                    <td class="border-b-2 text-xs text-center">{{$purchase -> po_number}}</td>
                    <td class="border-b-2 text-xs text-center">{{$purchase -> purchaseOrderSupplier -> supplier -> supplier_name}}</td>
                    <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchase -> requested_by}}</td>
                    <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchase -> prepared_by}}</td>
                    <td class="border-b-2 text-xs text-center capitalize">{{$purchase -> systemStatus -> status}}</td>

                    <td class="border-b-2 text-xs text-center capitalize">
                    @if($purchase -> payment_status == 0)
                        <button type="button" onclick="return confirm('Do you want to settle the payment for this Purchase Order?')"><a href='{{route('paymentdetails', ['purchase' => $purchase])}}'>Unpaid</a></button>
                    </td>
                    @else
                    Paid
                    @endif
                    <td class="border-b-2 text-xs text-center 
                    @if($purchase -> payment_status == 0)
                        @if($purchase-> purchaseOrderTerms -> payment_term == 1)
                            bg-green-500 text-gray-200
                        @endif
                
                    @php
                    $dueDate = strtotime($purchase->purchaseOrderTerms->due_date);
                    $today = strtotime('today');
                    $threeDaysAhead = strtotime('+3 days');
                    
                    if ($dueDate < $today) {
                        echo 'bg-red-500 text-gray-200'; // Overdue
                    } elseif ($dueDate <= $threeDaysAhead) {
                        echo 'bg-yellow-500 text-gray-200'; // Within 3 days
                    }
                @endphp
               
                @endif
                    ">
                        {{date('m-d-y', strtotime($purchase->purchaseOrderTerms->due_date))}}
                    </td>
                    <td class="border-b-2 text-xs text-center">
                        <div class="flex flex-row justify-center gap-2">
                            <div>
                                <a href="{{route('viewdetailspurchasingorder', ['purchase' => $purchase -> id])}}"><i class="fa-solid fa-pen-to-square text-teal-600 hover:text-teal-700"></i></a>
                            </div>
                            /
                             <div>
                                <form method="POST" action="{{route('purchasingorderdelete', ['purchase' => $purchase -> id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="" onclick="return confirm('Do you really want to delete this purchase order?')"><i class="fa-solid fa-trash text-red-600 hover:text-red-700"></i></button>
                                 </form>
                             </div>
                        </div>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-1 ml-2">
        <x-shopee-pagination :paginator="$purchases" />
    </div>

</div>

@endsection