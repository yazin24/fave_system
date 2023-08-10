@extends('purchasing.purchasing_home')

@section('purchasing-body')

<h2 class="font-bold md:text-xl">Settle Payment</h2>

<div class="mt-4">
    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="font-bold">
            <h2>PO Number: {{$purchase -> po_number}}</h2>
            <h2>Due Date: </h2>
            <h2>Expected Amount: ₱{{$totalAmount}}.00</h2>
            </div>

            <br>

            <form method="POST" id="settle_payment" action="{{route('updatepaymentstatus', ['id' => $purchase -> id])}}">
                @csrf
                @method('POST')
                <h2 class="mr-1 font-bold">Enter Amount: </h2>
            <div class="flex flex-row items-center text-sm font-bold"> 
                    <input type="number" class="text-xs h-6" name="amountPaid">
                    <button type="submit" class="ml-1 bg-teal-400 text-gray-200 hover:bg-teal-600 font-bold p-0.5 rounded-md">Submit</button>   
            </div>
            </form>
        </div>
    </div>
</div>


@endsection