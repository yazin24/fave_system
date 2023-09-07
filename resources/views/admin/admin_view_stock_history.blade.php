@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl mb-2">Item Log and Transaction History</h2>

<h3 class="font-bold">Item: {{ $stock->item_name }}</h3>

<div class="">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class=" bg-gray-900 border-b-2 text-gray-300 w-full">
                <th class="text-xs md:text-sm text-center w-1/3">DATE</th>
                <th class="text-xs md:text-sm text-center w-1/3">ACTION</th>
                <th class="text-xs md:text-sm text-center w-1/3">QUANTITY</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactionDetails as $transaction)
                <tr class="h-6 md:h-8">
                    <td class="border-b-2 text-xs text-center">{{ $transaction['DATE'] }}</td>
                    <td class="border-b-2 text-xs text-center">{{ $transaction['ACTION'] }}</td>
                    <td class="border-b-2 text-xs text-center">{{ $transaction['QUANTITY'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$transactionDetails" />
</div>



@endsection