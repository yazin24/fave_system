@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl">Stock Monitoring</h2>

<div class="mt-4">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="md:h-8 bg-gray-900 border-b-2 text-gray-300 w-full">
                <th class="text-sm text-center w-1/4">ITEM NAME</th>
                <th class="text-sm text-center w-1/4">ITEM UNIT</th>
                <th class="text-sm text-center w-1/4">TOTAL QUANTITY</th>
                <th class="text-sm text-center w-1/4">DEFAULT PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allStocks as $allStock)
                <tr class="h-10 w-full">
                    <td class="border-b-2 text-xs text-center font-bold w-1/4">{{$allStock -> item_name}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/4">{{$allStock -> item_unit}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/4">{{$allStock -> quantity}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/4">₱{{$allStock -> default_price}}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection