@extends('sales.sales_home')

@section('sales-body')

<div class="bg-white-900 text-gray-900 mt-2">
    <div class="flex flex-row justify-between">
            <div>
                    <h2 class="font-bold text-gray-900">Tiktok Orders</h2>
            </div>
            <div class="mb-1">
                    <button class="bg-gray-900 hover:bg-gray-900 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('tiktoksalesform')}}">Tiktok</a></button>
            </div>
    </div>
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-6">
                    <th class="text-xs text-center w-1/5">ORDER ID</th>
                    <th class="text-xs text-center w-1/5">FULL NAME</th>
                    <th class="text-xs text-center w-1/5">ADDRESS</th>
                    <th class="text-xs text-center w-1/5">NUMBER</th>
                    <th class="text-xs text-center w-1/5">ACTION</th>
            </tr>
        </thead>
        <tbody>
           @foreach($allTiktokSales as $tiktokSale)
            <tr class="h-6">
                    <td class="border-b-2 text-xs text-center">{{$tiktokSale -> order_id}}</td>
                    <td class="border-b-2 text-xs text-center">{{$tiktokSale -> customers_name}}</td>
                    <td class="border-b-2 text-xs text-center whitespace-nowrap">{{$tiktokSale -> customers_address}}</td>
                    <td class="border-b-2 text-xs text-center">{{$tiktokSale -> phone_number}}</td>
                    <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="">View</a></td>
            </tr>
           @endforeach  
        </tbody>
    </table>
</div>
{{-- <div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$allLazadaSales" />
</div> --}}
{{-- {{$agent -> created_at -> format('Y-m-d h:s:i A')}} --}}

        
<div class="bg-white-900 text-gray-900 mt-2">
    <div class="flex flex-row justify-between">
            <div>
                    <h2 class="font-bold text-red-600">Carousel Orders</h2>
            </div>
            <div class="mb-1">
                    <button class="bg-red-600 hover:bg-red-700 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('carouselsalesform')}}">Carousel</a></button>
            </div>
    </div>

    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-6">
                <th class="text-xs text-center w-1/5">ORDER ID</th>
                <th class="text-xs text-center w-1/5">FULL NAME</th>
                <th class="text-xs text-center w-1/5">ADDRESS</th>
                <th class="text-xs text-center w-1/5">NUMBER</th>
                <th class="text-xs text-center w-1/5">ACTION</th>
            </tr>
        </thead>
        <tbody>
           {{-- @foreach($allShopeeSales as $shopeeSale) --}}
            <tr class="h-6">
                <td class="border-b-2 text-xs text-center"></td>
                <td class="border-b-2 text-xs text-center"></td>
                <td class="border-b-2 text-xs text-center"></td>
                <td class="border-b-2 text-xs text-center"></td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="">View</a></td>
            </tr>
           {{-- @endforeach   --}}
        </tbody>
    </table>
</div>
{{-- <div class="ml-2 mt-1">
    <x-shopee-pagination :paginator="$allShopeeSales" />
</div> --}}
{{-- {{$agent -> created_at -> format('Y-m-d h:s:i A')}} --}}



@endsection