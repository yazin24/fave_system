@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Add Stock</h2>

<div class="mt-2 md:mt-4">
    <form method="POST" action="{{route('addstock', ['allProduct' => $allProduct])}}">
        @csrf
        @method('PUT')
    <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-col mb-4"> 
                
                    <h2 class="text-xs text-gray-800 font-bold mb-2">SKU NAME: <span class="text-blue-600 font-bold">{{$allProduct -> full_name}}</span></h2>
                    <h2 class="text-xs text-gray-800 font-bold mb-2">VARIANT: <span class="text-blue-600 font-bold capitalize">{{$allProduct -> productVariants -> variant_name}}</span></h2>
                    <h2 class="text-xs text-gray-800 font-bold mb-2">SIZE: <span class="text-blue-600 font-bold">
                        @if($allProduct -> sku_size == 3785.41) 1 Gallon
                        @elseif($allProduct -> sku_size == 1000) 1 Liter
                        @else 500 ml
                        @endif    
                    </span></h2>
                    <h2 class="text-xs text-gray-800 font-bold mb-2">ENTER QUANTITY: <input type="number" class="h-6 w-24 text-xs" name="quantity"></h2>
                </div>
                 <button type="submit" class="text-xs bg-teal-500 hover:bg-teal-600 font-bold text-gray-200 p-1 rounded-md shadow-md">
                 Update Stocks
                </button>
            </div>
         
    </form>

</div>


@endsection