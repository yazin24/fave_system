@extends('superadmin.superadmin_home')

@section('superadmin-body')

<h2 class="font-bold">Manual Order Sales Monitoring</h2>

<div class="bg-white-900 text-gray-900 mt-1">
    <div class="flex justify-end">
        <form method="GET" action="{{route('manualpurchaseorder')}}">
            <button class="bg-teal-500 hover:bg-teal-600 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md mb-1"><a>Create New</a></button>
        </form>
        
    </div>
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 md:h-12">
                <th class="text-xs md:font-bold text-center w-1/5">PO_NUMBER</th>
                <th class="text-xs md:font-bold text-center w-1/5">CUSTOMER'S NAME</th>
                <th class="text-xs text-center w-1/5">CP NUMBER</th>
                <th class="text-xs text-center w-1/5">ADDRESS</th>
                <th class="text-xs text-center w-1/5">ACTION</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($allManualPurchaseOrders as $manualPurchase)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$manualPurchase ->  po_number}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase ->  customers_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase -> contact_number}}</td>
                <td class="border-b-2 text-xs text-center">{{$manualPurchase -> address}}</td>
                <td class="border-b-2 text-xs text-center">
                    <div class="flex flex-row justify-center gap-2">
                        <div>
                            <a href="{{route('manualorderdetailstoedit', ['manualOrder' => $manualPurchase -> id])}}"><i class="fa-solid fa-pen-to-square text-teal-600 rounded-sm hover:text-teal-700"></i></a>
                        </div>
                       /
                        <div>  
                            <form method="POST" action="{{route('manualorderdelete', ['manualOrder' => $manualPurchase -> id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this manual purchase order?')"><i class="fa-solid fa-trash text-red-600 rounded-sm  hover:text-red-700"></i></a></button>
                            </form> 
                        </div>
                    </div>
                   
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="ml-2 mt-1">
    <x-shopee-pagination :paginator="$allManualPurchaseOrders" />
</div>


@endsection