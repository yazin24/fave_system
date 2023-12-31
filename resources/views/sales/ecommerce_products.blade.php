@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Products and Details</h2>


<div class="flex flex-row justify-end">
    {{-- <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Customers</button>
    </div>
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Products</button>
    </div>
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Ongoing</button>
    </div ">
    <div class="mr-2">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Delivered</button>
    </div>
    <div class="">
        <button class="bg-gray-800 text-gray-200 p-1 rounded-sm text-sm font-bold">Sales</button>
    </div> --}}
</div>
<div class="bg-white-900 text-gray-900 mt-1"> 
    <table class="w-full shadow-md bg-gray-400">
        <thead>
            <tr class="bg-gray-800 text-gray-200 h-8 md:h-10 text-xs">
                <th class="text-xs w-1/6 font-bold">BARCODE</th>
                <th class="text-xs w-1/6 font-bold">PRODUCT NAME</th>
                <th class="text-xs w-1/6 font-bold">VARIANTS</th>
                <th class="text-xs w-1/6 font-bold">SIZE</th>
                <th class="text-xs w-1/6 font-bold">QUANTITY</th>
                <th class="text-xs w-1/6 font-bold">ACTION</th>
                
            </tr>
        </thead>    

        <tbody class="bg-gray-300">
            @foreach($allProducts as $product)
            <tr class="h-10">   
                <td class="text-xs text-center border-b-2 font-bold">{{$product -> barcode}}</td>
                <td class="text-xs text-center border-b-2 font-bold">{{$product -> full_name}}</td>
                <td class="text-xs text-center border-b-2 font-bold">{{$product -> productVariants -> variant_name}}</td>
                <td class="text-xs text-center border-b-2 font-bold">
                    @if($product -> sku_size == 3785.41) 1 Gallon
                    @elseif($product -> sku_size == 1000) 1 Liter
                    @elseif($product -> sku_size == 900) 900g
                    @else 180g
                    @endif
                </td>
                <td class="text-xs text-center border-b-2 font-bold">{{$product -> sku_quantity}}</td>
                <td class="text-xs text-center border-b-2 font-bold"><i class="fa-solid fa-eye text-lg text-yellow-500 hover:text-yellow-600"></i></td>
            </tr>
              @endforeach
        </tbody>
    </table>
</div>


@endsection