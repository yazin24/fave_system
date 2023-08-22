@extends('sales.sales_home')

@section('sales-body')

<h2>Create Purchase Order</h2>

<div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2 w-full justify-center">

    <h2 class="text-center text-gray-200 font-bold md:text-2xl mb-2"> * Customer Purchase Order * </h2>

    <p class="text-gray-300 flex flex-col text-[10px] mb-1">
        <span>**Retail Price: 1L = 35.00 1Gal = 129.00</span>
        <span>**Wholesale Price: 1L = 29.00 1Gal = 115.00</span>
    </p>
   

    <form method="POST" action="">
    @csrf
    @method('POST')
        <div class="flex flex-row mb-1">
{{--            
            <select id="customer_name" name="customer_name" class="w-full h-8 text-xs" required>
                <option value="" disabled selected>Choose Customer</option>
                @foreach($agentCustomers as $agentCustomer)
                <option value="{{$agentCustomer -> id}}">{{$agentCustomer -> full_name}}</option>
                @endforeach
            </select> --}}
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

        <div>
    <button type="submit" id="add-item" class="flex items-center justify-center bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2 text-xs">Submit</button>
    </div>

</form>
</div>


@endsection