@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Input Product</h2>

<div class="mt-2 md:mt-4">
    
    <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">
        <form method="POST" action="{{route('addproductsku')}}">
            @csrf
        <div class="bg-gray-200 px-4 py-4">
            <div class="flex flex-wrap justify-between md:mx-8">
            @foreach($allVariants as $allVariant)
            <div class="flex flex-row items-center">
                <input type="checkbox" name="variant_name" value="{{$allVariant -> id}}">
                <label class="text-gray-800 font-bold ml-1">{{$allVariant -> variant_name}}</label>
            </div>
            @endforeach
        </div>
        <div class="mt-4 font-bold">
            <div>
                <label>Barcode</label>
                <input type="text" name="barcode" class="h-8 w-full" required>
            </div>
            <div>
                <label>Sku Name</label>
                <input type="text" name="sku_name" class="h-8 w-full" required>
            </div>
            <div>
                <label>Choose SKU Size</label>
                <select id="" name="sku_size" class="w-full text-gray-500 text-xs h-8" required>
                    <option value="" disabled selected>-</option>
                    <option value="450">450ml</option>
                    <option value="1000">1L</option>
                    <option value=3785.41>1Gallon</option>
                    
                </select>
            </div>
            <div>
                <label>SKU Quantity</label>
                <input type="number" name="sku_quantity" class="h-8 w-full">
            </div>
            <div class="mt-4">
                <button type="submit" class="p-1 bg-teal-500 text-gray-200 font-bold hover:bg-teal-600 rounded-md shadow-md">Submit</button>
            </div>
        </div>
        </div>
        </form>
     </div>

</div>

@endsection