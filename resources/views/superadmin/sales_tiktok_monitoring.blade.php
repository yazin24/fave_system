@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2>Tiktok Sales Monitoring</h2>

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
           @foreach($allTiktokOrders as $tiktokSale)
            <tr class="h-6">
                
                <td class="border-b-2 text-xs text-center">{{$tiktokSale -> order_id}}</td>
                <td class="border-b-2 text-xs text-center">{{$tiktokSale -> customers_name}}</td>
                <td class="border-b-2 text-xs text-center text-[9px]">{{$tiktokSale -> customers_address}}</td>
                <td class="border-b-2 text-xs text-center">{{$tiktokSale -> phone_number}}</td>
                <td class="border-b-2 text-xs text-center">
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <a href="{{route('tiktokorderdetailstoedit', ['tiktokOrder' => $tiktokSale -> id])}}"><i class="fa-solid fa-pen-to-square text-teal-600 rounded-sm hover:text-teal-700"></i></a>
                        </div>
                       /
                        {{-- <div>  
                            <form method="POST" action="{{route('shopeeorderdelete', ['tiktokOrder' => $tiktokSale -> id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this shopee order?')"><i class="fa-solid fa-trash text-red-600 rounded-sm  hover:text-red-700"></i></a></button>
                            </form> 
                        </div> --}}
                    </div>

                </td>
            </tr>
           @endforeach  
        </tbody>
    </table>
    <div class="ml-2 mt-1">
        <x-shopee-pagination :paginator="$allTiktokOrders" />
    </div>
</diiv>

@endsection