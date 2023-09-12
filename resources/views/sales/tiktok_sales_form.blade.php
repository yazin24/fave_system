@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2 text-gray-900 mb-2">Tiktok</h2>
@if($errors -> any())
<div class="text-red-600 font-bold text-xs">
    <ul>
        @foreach($errors -> all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="rounded-sm shadow-lg bg-gray-900 p-1 lg:w-1/2 justify-center font-bold">

    <div class="bg-gray-200 px-2 py-2">
        
        <form method="POST" action="{{route('addtiktoksales')}}">
            @csrf
            <div>
                <input type="text" name="order_id" placeholder="Order ID" class="h-6 w-full mb-0.5 text-xs" required>
            </div>
            <div>
                <input type="text" name="full_name" placeholder="Full Name" class="h-6 w-full mb-0.5 text-xs" required>
            </div>
            <div>
                <input type="text" name="customers_address" placeholder="Full Address" class="h-6 w-full mb-0.5 text-xs" required>
            </div>
            <div>
                <input type="text" name="phone_number" placeholder="Phone Number" class="h-6 w-full mb-1 text-xs" required>
            </div>
            <div class="flex flex-row mb-1">
                <input type="number" step="0.01" name="charges_and_fees" placeholder="Charges & Fees" class="h-6 w-full text-xs">
                <input type="number" step="0.01" name="voucher" placeholder="Voucher" class="h-6 w-full mb-0.5 text-xs">
            </div>
            <div class="mb-0.5">
                <select class="h-8 text-xs py-0" name="status" required>
                    <option value="" disabled selected>Choose Status</option>
                    {{-- <option value="" disabled selected>Delivered</option> --}}
                    <option value=7>Undelivered</option>
                </select>
            </div>

            <div id="item-container" class="flex flex-col">
                @foreach($allProducts as $allProduct)
                <div class="flex flex-row justify-center">
    
                    <div class="mt-0.5">
                        <input type="checkbox" name="selected_product[]" value="{{$allProduct -> id}}" class="text-xs">
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-6 text-xs mb-0.5" value="{{$allProduct -> full_name}}" readonly>
                        <input type="hidden" name="product_id[{{$allProduct -> id}}]" value="{{$allProduct -> id}}">
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-6 text-xs mb-0.5" value="@if($allProduct -> productVariants -> variant_name === 'Calamansi') C @elseif($allProduct -> productVariants -> variant_name === 'Honey Lemon') HL @elseif($allProduct -> productVariants -> variant_name === 'Fresh Antibac') FA @endif" readonly>
                    </div>
    
                    <div class="w-full">
                        <input type="text" class="w-full h-6 text-xs mb-0.5" value="@if($allProduct -> sku_size == 3785.41) 1Gal @elseif($allProduct -> sku_size == 1000) 1Liter @elseif($allProduct -> sku_size == 500) 500ml @endif " readonly>
                        
                    </div>
    
                    <div class="w-full">
                        <input type="number" name="price[{{$allProduct -> id}}]" class="w-full h-6 text-xs mb-0.5" placeholder="price">
                    </div>
    
                    <div class="w-full">
                        <input type="number" name="quantity[{{$allProduct -> id}}]" class="w-full h-6 text-xs" placeholder="quantity">
                    </div> 
                </div>
                @endforeach
            </div>

            <div class="mt-2">
                <button type="submit" class="bg-gray-900 hover:bg-gray-700 font-bold p-1 text-xs rounded-md text-gray-200">Submit</button>
            </div>
        </form>

    </div>

</div>


@endsection