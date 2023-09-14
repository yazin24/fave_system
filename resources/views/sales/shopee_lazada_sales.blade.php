@extends('sales.sales_home')

@section('sales-body')
        
<div class="bg-white-900 text-gray-900 mt-2">
        <div class="flex flex-row justify-between">
                <div>
                        <h2 class="font-bold text-orange-600">Shopee Orders</h2>
                </div>
                <div class="mb-1">
                        <button class="bg-orange-600 hover:bg-orange-700 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('shopeesalesform')}}">Shopee</a></button>
                </div>
        </div>

        <table class="bg-gray-300 shadow-lg w-full">
            <thead>
                <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-6">
                    <th class="text-xs text-center w-1/5">ACTION</th>
                    <th class="text-xs text-center w-1/5">ORDER ID</th>
                    <th class="text-xs text-center w-1/5">FULL NAME</th>
                    <th class="text-xs text-center w-1/5">NUMBER</th>
                    <th class="text-xs text-center w-2/5">ADDRESS</th>
                    
                    
                </tr>
            </thead>
            <tbody>
               @foreach($allShopeeSales as $shopeeSale)
                <tr class="h-6">
                    <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('shopeeorderdetails', ['shopeeSale' => $shopeeSale -> id])}}">View</a></td>
                    <td class="border-b-2 text-xs text-center">{{$shopeeSale -> order_id}}</td>
                    <td class="border-b-2 text-xs text-center">{{$shopeeSale -> customers_name}}</td>
                    <td class="border-b-2 text-xs text-center">{{$shopeeSale -> phone_number}}</td>
                    <td class="border-b-2 text-xs text-center mx-auto max-w-md overflow-hidden whitespace-nowrap overflow-ellipsis">{{$shopeeSale -> customers_address}}</td>
                </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
    <div class="ml-2 mt-1">
        <x-shopee-pagination :paginator="$allShopeeSales" />
    </div>
    {{-- {{$agent -> created_at -> format('Y-m-d h:s:i A')}} --}}

    <div class="bg-white-900 text-gray-900 mt-2">
        <div class="flex flex-row justify-between">
                <div>
                        <h2 class="font-bold text-blue-900">Lazada Orders</h2>
                </div>
                <div class="mb-1">
                        <button class="bg-blue-900 hover:bg-blue-800 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('lazadasalesform')}}">Lazada</a></button>
                </div>
        </div>
        <table class="bg-gray-300 shadow-lg w-full">
            <thead>
                <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-6">
                    <th class="text-xs text-center w-1/5">ACTION</th>
                        <th class="text-xs text-center w-1/5">ORDER NUMBER</th>
                        <th class="text-xs text-center w-1/5">FULL NAME</th>
                        <th class="text-xs text-center w-1/5">NUMBER</th>
                        <th class="text-xs text-center w-1/5">ADDRESS</th>
                        
                </tr>
            </thead>
            <tbody>
               @foreach($allLazadaSales as $lazadaSale)
                <tr class="h-6">
                    <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('lazadaorderdetails', ['lazadaSale' => $lazadaSale])}}">View</a></td>
                        <td class="border-b-2 text-xs text-center">{{$lazadaSale -> order_number}}</td>
                        <td class="border-b-2 text-xs text-center">{{$lazadaSale -> customers_name}}</td>
                        
                        <td class="border-b-2 text-xs text-center">{{$lazadaSale -> phone_number}}</td>
                        <td class="border-b-2 text-xs text-center mx-auto max-w-md overflow-hidden whitespace-nowrap overflow-ellipsis">{{$lazadaSale -> customers_address}}</td>
                        
                </tr>
               @endforeach  
            </tbody>
        </table>
    </div>
    <div class="mt-1 ml-2">
        <x-shopee-pagination :paginator="$allLazadaSales" />
    </div>
    {{-- {{$agent -> created_at -> format('Y-m-d h:s:i A')}} --}}


@endsection