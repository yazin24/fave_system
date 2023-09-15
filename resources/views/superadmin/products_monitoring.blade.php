@extends('superadmin.superadmin_home')

@section('superadmin-body')

    <h2>Products Monitoring</h2>

<div class="flex justify-end">
    <button class="bg-teal-500 hover:bg-teal-600 font-bold p-1 text-xs rounded-sm shadow-md text-gray-200"><a href="{{route('productinput')}}"> Add Products</a></button>
</div>


<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                {{-- <th class="text-xs md:text-sm text-center w-1/5">BARCODE</th> --}}
                <th class="text-xs md:text-sm text-center w-1/5">VARIANT</th>
                <th class="text-xs md:text-sm text-center w-1/5">SKU NAME</th>
                <th class="text-xs md:text-sm text-center w-1/5">SIZE</th>
                <th class="text-xs md:text-sm text-center w-1/5">QUANTITY</th>
                <th class="text-xs md:text-sm text-center w-1/5">ACTION</th>
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-8">
                @foreach($allProducts as $allProduct)
                {{-- <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10">{{$allProduct -> barcode}}</td> --}}
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-8">{{$allProduct -> productVariants -> variant_name}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 h-8">{{$allProduct -> full_name}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 h-8">
                    @if($allProduct -> sku_size == 3785.41)
                    1 Gallon
                    @elseif($allProduct -> sku_size == 1000)
                    1 Liter
                    @elseif($allProduct -> sku_size == 900)
                    900 Grams
                    @else
                    180 Grams
                    @endif
                </td>
                <td class="border-b-2 text-xs text-center w-1/6 font-bold">{{$allProduct -> sku_quantity}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 text-red-500 hover:text-red-600 hover:font-bold hover:underline"><a href="{{route('viewproductlogs', ['allProduct' => $allProduct])}}">View</a></td>
            </tr>
                @endforeach
        </tbody>
    </table>
</div>

@endsection