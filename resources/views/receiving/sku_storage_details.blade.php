@extends('receiving.receiving_home')

@section('receiving-body')

        <h2 class="font-bold md:text-xl mt-2">Storage Details</h2>

        <div class="mt-2 md:mt-4">
           <div class="bg-gray-900 p-2 rounded-sm shadow-md">
                <div class="bg-gray-200 p-2 rounded-sm">
                    <h2 class="font-bold mb-2">Codename: {{$storageSku -> productSku -> full_name}}</h2>
                    <h2 class="font-bold mb-2">Variant: {{$storageSku -> productSku -> productVariants -> variant_name}}</h2>
                    <h2 class="font-bold mb-2">Size: 
                        @if($storageSku -> productSku -> sku_size == 3785.41) 1 Gallon
                        @elseif($storageSku -> productSku -> sku_size == 1000) 1 Liter
                        @elseif($storageSku -> productSku -> sku_size == 900) 900 Grams
                        @elseif($storageSku -> productSku -> sku_size == 180) 180 Grams
                        @endif
                    </h2>
                    <h2 class="font-bold mb-2">Total Quantity(Drums): {{$storageSku -> quantity}}</h2>
                    <div class="flex flex-row justify-between">
                        <div class="mt-2">
                            <button class="bg-teal-500 p-1 text-xs rounded-md font-bold text-gray-200 shadow-md mr-1"><a href=""><i class="fa-regular fa-square-plus mr-1"></i>Log History</a></button>
                        </div>
                    
                        <div class="flex flex-row items-center mt-2">
                            <div>
                                <button class="bg-teal-500 p-1 text-xs rounded-md font-bold text-gray-200 shadow-md"><a href="{{route('storageoutputform', ['storageSku' => $storageSku -> id])}}"><i class="fa-regular fa-square-minus mr-1"></i>Output</a></button>
                            </div>
                        </div>
                       
                    
                    </div>
                </div>
           </div>
        </div>


@endsection