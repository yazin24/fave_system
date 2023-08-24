@extends('admin.admin_home')

@section('admin-body')


        <div class="w-full">
            <h2 class="font-bold md:text-xl mt-2">Products List</h2>

            <div class="flex justify-end">
                <button class="bg-teal-500 hover:bg-teal-600 font-bold p-1 text-xs rounded-md shadow-md text-gray-200"><a href="{{route('admininputproducts')}}"> Add Products</a></button>
            </div>
            
            
            <div class="bg-white-900 text-gray-900 mt-1">
                <table class="bg-gray-300 shadow-lg w-full">
                    <thead class="">
                        <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                            <th class="text-xs md:text-sm text-center w-1/5">BARCODE</th>
                            <th class="text-xs md:text-sm text-center w-1/5">VARIANT</th>
                            <th class="text-xs md:text-sm text-center w-1/5">SKU NAME</th>
                            <th class="text-xs md:text-sm text-center w-1/5">SIZE</th>
                            <th class="text-xs md:text-sm text-center w-1/5">QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr class="h-10">
                            @foreach($allProducts as $allProduct)
                            <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10">{{$allProduct -> barcode}}</td>
                            <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10">{{$allProduct -> productVariants -> variant_name}}</td>
                            <td class="border-b-2 text-xs text-center w-1/6 h-10">{{$allProduct -> full_name}}</td>
                            <td class="border-b-2 text-xs text-center w-1/6 h-10">
                                @if($allProduct -> sku_size == 3785.41)
                                1 Gallon
                                @elseif($allProduct -> sku_size == 1000)
                                1 Liter
                                @else
                                450 ml
                                @endif
                            </td>
                            <td class="border-b-2 text-xs text-center w-1/6 font-bold">{{$allProduct -> sku_quantity}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection