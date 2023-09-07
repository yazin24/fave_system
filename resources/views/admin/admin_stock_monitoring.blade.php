@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl">Stock Monitoring</h2>

<div class="mt-4">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="md:h-8 bg-gray-900 border-b-2 text-gray-300 w-full">
                <th class="text-xs md:text-sm text-center w-1/5">ITEM NAME</th>
                <th class="text-xs md:text-sm text-center w-1/5">ITEM UNIT</th>
                <th class="text-xs md:text-sm text-center w-1/5">TOTAL QUANTITY</th>
                <th class="text-xs md:text-sm text-center w-1/5">DEFAULT PRICE</th>
                <th class="text-xs md:text-sm text-center w-1/5">HISTORY</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($allStocks as $allStock)
                <tr class="h-6 md:h-10 w-full">
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$allStock -> item_name}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$allStock -> item_unit}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$allStock -> quantity}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">₱{{$allStock -> default_price}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5 text-red-500 hover:text-red-600 hover:underline"><a href="{{route('viewstockhistory', ['stock' => $allStock -> id])}}">View</a></td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection