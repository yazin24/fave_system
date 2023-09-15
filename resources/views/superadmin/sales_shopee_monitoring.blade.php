@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2>Shopee Sales Monitoring</h2>

<diiv>
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
           @foreach($allShopeeSales as $shopeeSale)
            <tr class="h-6">
                
                <td class="border-b-2 text-xs text-center">{{$shopeeSale -> order_id}}</td>
                <td class="border-b-2 text-xs text-center">{{$shopeeSale -> customers_name}}</td>
                <td class="border-b-2 text-xs text-center text-[9px]">{{$shopeeSale -> customers_address}}</td>
                <td class="border-b-2 text-xs text-center">{{$shopeeSale -> phone_number}}</td>
                <td class="border-b-2 text-xs text-center">
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <a href="{{route('shopeeorderdetailstoedit', ['shopeeOrder' => $shopeeSale -> id])}}"><i class="fa-solid fa-pen-to-square text-teal-600 rounded-sm hover:text-teal-700"></i></a>
                        </div>
                       |
                        <div>   
                            <a href="{{route('shopeeorderdetails', ['shopeeSale' => $shopeeSale -> id])}}"><i class="fa-solid fa-trash text-red-600 rounded-sm  hover:text-red-700"></i></a>
                        </div>
                    </div>
                   
                    

                </td>
            </tr>
           @endforeach  
        </tbody>
    </table>
    <div class="ml-2 mt-1">
        <x-shopee-pagination :paginator="$allShopeeSales" />
    </div>
</diiv>

@endsection