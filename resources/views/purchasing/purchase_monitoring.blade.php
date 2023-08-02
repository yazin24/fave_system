@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold md:text-xl mt-2">Purchase Monitoring</h2>


<div class="mt-1">

    <div class="flex flex-row w-full">

    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-xl">Purchase: </div>
        <div class="text-xs md:text-xl"> {{$totalPurchase}}</div>
    </div>
    
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-xl">Total:</div>
        <div class="text-xs md:text-xl">₱{{ $totalAmount % 1 === 0 ? number_format($totalAmount, 0) : number_format($totalAmount, 2) }}</div>
    </div>
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 mr-2 w-1/4">
        <div class="mr-2 text-xs md:text-xl">Queue:</div>
        <div class="text-xs md:text-xl">{{$purchaseQueue}}</div>
    </div>
    <div class="flex flex-row justify-center items-center bg-gray-900 text-gray-200 p-1 md:p-4 w-1/4">
        <div class="mr-2 text-xs md:text-xl">Latest:</div>
        <div class="text-xs md:text-xl">12-14</div>
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
                    <td class="border-b-2 text-xs text-center">{{$purchase -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchase -> requested_by}}</td>
                    <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$purchase -> prepared_by}}</td>
                    <td class="border-b-2 text-xs text-center capitalize">{{$purchase -> systemStatus -> status}}</td>

                    <td class="border-b-2 text-xs text-center capitalize">
                    @if($purchase -> payment_status == 0)
                    <form method="POST" id="purchasePaid" action="{{ route('updatepaymentstatus', ['id' => $purchase->id]) }}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="confirmPaid" id="confirmPaid" value="">
                        <button type="button" onclick="openModal()">Unpaid</button>
                    </form>
                    </td>
                    @else
                    Paid
                    @endif
                    <td class="border-b-2 text-xs text-center 
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
                    <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewpurchase', ['purchase' => $purchase])}}">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
       
    </div>

    <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex justify-center items-start z-50">
        <div class="bg-white p-4 rounded mt-44">
            <h2 class="text-sm font-bold mb-2">Enter Payment Amount:</h2>
            <div class="flex flex-col">
                <div class="w-full">
                    <input type="number" id="paymentAmount" class="text-xs border p-2 mr-2 w-60 md:w-96 rounded-sm">
                    <input type="hidden" name="purchaseId" id="purchaseId" value="">
                    <input type="hidden" name="amountPaid" id="amountPaid" value="">
                </div>
                <div class="mt-4 flex justify-end">
                <button type="button" onclick="confirmPayment()" class="text-xs bg-teal-300 hover:bg-teal-500 p-1 rounded-md mr-4 text-gray-200 font-bold"><i class="fa-regular fa-circle-check font-bold"></i> Confirm</button>
                <button type="button" onclick="closeModal()" class="text-xs p-1 bg-red-300 hover:bg-red-500 text-gray-200 rounded-md"><i class="fa-regular fa-circle-xmark font-bold"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function openModal(purchaseId) {
        document.getElementById('paymentModal').classList.remove('hidden');
        document.getElementById('purchaseId').value = purchaseId;
    }

    function closeModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }

    function confirmPayment() {
        const inputValue = document.getElementById('paymentAmount').value;
        const purchaseId = document.getElementById('purchaseId').value;

        if (inputValue !== '' && parseFloat(inputValue) > 0) {
            document.getElementById('confirmPaid').value = inputValue;
            document.getElementById('purchasePaid').submit();
        } else {
            alert('Please enter a valid payment amount!');
        }
    }
</script>

@endsection