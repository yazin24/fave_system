@extends('receiving.receiving_home')

@section('receiving-body')


<div class="mt-2 md:mt-4">
    <div class="bg-gray-900 p-2 rounded-sm shadow-md w-full lg:w-1/2">
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
             <div class="flex justify-end ml-2">
                <x-shopee-pagination :paginator="$logs" />
            </div>
         </div>
         <div class="bg-white-900 text-gray-900 mt-1 items-center">
            <table class="bg-gray-300 shadow-lg w-full">
                <thead class="">
                    <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 h-8">
                        <th class="text-sm text-center w-1/6">QUANTITY</th>
                        <th class="text-sm text-center w-1/6">ACTION</th>
                        <th class="text-sm text-center w-1/6">DATE</th>
                       
                    </tr>
                </thead>
                <tbody>
                   
                    <tr class="h-8">
                       @foreach ($logs as $log)
                           
                        <td class="border-b-2 text-xs text-center w-1/6 capitalize h-8">{{$log -> quantity}}</td>
                        <td class="border-b-2 text-xs text-center w-1/6 h-8">
                            @if($log -> action === 'Add') Input
                            @else Output
                            @endif
                        </td>
                        
                        <td class="border-b-2 text-xs text-center w-1/6 h-8">{{date('Y-m-d', strtotime($log -> created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
 </div>



@endsection