@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl">Stock Monitoring</h2>

<div class="mt-4">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="md:h-8 bg-gray-900 border-b-2 text-gray-300">
                <th class="text-sm text-center ">ITEM NAME</th>
                <th class="text-sm text-center ">TOTAL QUANTITY</th>
                <th class="text-sm text-center ">DEFAULT PRICE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allStocks as $allStock)
                <tr class="h-10">
                    <td class="border-b-2 text-xs text-center font-bold">{{$allStock -> item_name}}</td>
                    <td class="border-b-2 text-xs text-center font-bold">{{$allStock -> quantity}}</td>
                    <td class="border-b-2 text-xs text-center font-bold">₱{{$allStock -> default_price}}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection