@extends('superadmin.superadmin_home')

@section('superadmin-body')

<div class="">
    <div class="flex flex-row justify-between mb-1">
        <h2 class="font-bold mt-2">Raw Materials Monitoring</h2>
        <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold text-gray-200 rounded-sm items-center"><a href="{{route('newrawmaterials')}}">Add New</a></button>
    </div>
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
            @foreach($rawMaterials as $rawMaterial)
                <tr class="h-6 md:h-10 w-full">
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$rawMaterial -> item_name}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$rawMaterial -> item_unit}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">{{$rawMaterial -> quantity}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5">₱{{$rawMaterial -> default_price}}</td>
                    <td class="border-b-2 text-xs text-center font-bold w-1/5 text-red-500 hover:text-red-600 hover:underline"><a href="{{route('viewrawmaterialsinfo', ['rawMaterial' => $rawMaterial -> id])}}">View</a></td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$rawMaterials" />
</div>

@endsection