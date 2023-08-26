@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2 text-orange-600 mb-2">Shopee</h2>

<div class="rounded-md shadow-lg bg-orange-600 p-2 lg:w-1/2 justify-center">

    <div class="bg-gray-200 px-4 py-4 flex flex-col">
        
        <form method="POST" action="{{route('addshopeesales')}}">
            @csrf
            <div>
                <input type="text" name="order_id" placeholder="Order ID" class="h-6 w-full mb-2">
            </div>
            <div>
                <input type="text" name="full_name" placeholder="Full Name" class="h-8 w-full mb-2">
            </div>
            <div>
                <input type="text" name="customers_address" placeholder="Full Address" class="h-8 w-full mb-2">
            </div>
            <div>
                <input type="text" name="phone_number" placeholder="Phone Number" class="h-8 w-full mb-2">
            </div>
            <div class="mb-2">
                <select class="h-8 text-xs" name="status">
                    <option value="" disabled selected>Choose Status</option>
                    <option value=4>Delivered</option>
                    <option value=7>Undelivered</option>
                </select>
            </div>

            <div id="item-container" class="flex flex-col">
                @foreach($allProducts as $allProduct)
                <div class="flex flex-row justify-center">
    
                    <div class="mt-2.5">
                        <input type="checkbox" name="selected_product[]" value="{{$allProduct -> id}}" class="">
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-8 text-xs mb-1" value="{{$allProduct -> full_name}}" readonly>
                        <input type="hidden" name="product_id[{{$allProduct -> id}}]" value="{{$allProduct -> id}}">
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-8 text-xs mb-1" value="@if($allProduct -> productVariants -> variant_name === 'Calamansi') C @elseif($allProduct -> productVariants -> variant_name === 'Honey Lemon') HL @elseif($allProduct -> productVariants -> variant_name === 'Fresh Antibac') FA @endif" readonly>
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-8 text-xs mb-1" value="@if($allProduct -> sku_size == 3785.41) 1Gal @elseif($allProduct -> sku_size == 1000) 1Liter @elseif($allProduct -> sku_size == 500) 500ml @endif " readonly>
                        
                    </div>
    
                    <div class="w-full">
                        <input type="number" name="price[{{$allProduct -> id}}]" class="w-full h-8 text-xs mb-1" placeholder="price">
                    </div>
    
                    <div class="w-full">
                        <input type="number" name="quantity[{{$allProduct -> id}}]" class="w-full h-8 text-xs" placeholder="quantity">
                    </div> 
                </div>
                @endforeach
            </div>

            <div class="mt-2">
                <button type="submit" class="bg-orange-600 hover:bg-orange-700 font-bold p-1 text-xs rounded-md text-gray-200">Submit</button>
            </div>
        </form>

    </div>

</div>


@endsection