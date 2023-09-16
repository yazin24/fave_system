@extends('superadmin.superadmin_home')

@section('superadmin-body')

<div class="flex flex-row justify-between">
    <div>
        <h2 class="font-bold md:text-xl mt-2">Products Storage Monitoring</h2>
    </div>
   

</div>


<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-sm text-center w-1/6">VARIANT</th>
                <th class="text-sm text-center w-1/6">SIZE</th>
                <th class="text-sm text-center w-1/6">QUANTITY/DRUMS</th>
                <th class="text-sm text-center w-1/6">DETAILS</th>
            </tr>
        </thead>
        <tbody>
           
            <tr class="h-10">
               @foreach ($storageSkus as $storageSku)
                   
                <td class="border-b-2 text-xs text-center w-1/6 capitalize h-10">{{$storageSku -> productSku -> productVariants -> variant_name}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 h-10">
                        @if($storageSku -> productSku -> sku_size == 3785.41) 1 Gallon
                        @elseif($storageSku -> productSku -> sku_size == 1000) 1 Liter
                        @elseif($storageSku -> productSku -> sku_size == 900) 900 Grams
                        @elseif($storageSku -> productSku -> sku_size == 180) 180 Grams
                        @endif
                </td>
                
                <td class="border-b-2 text-xs text-center w-1/6 h-10">{{$storageSku -> quantity}}</td>
                <td class="border-b-2 text-xs text-center w-1/6 hover:underline text-red-600 hover:font-bold"><a href="{{route('viewstorageskudetails', ['storageSku' => $storageSku -> id])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection