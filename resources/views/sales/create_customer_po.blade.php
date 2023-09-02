@extends('sales.sales_home')

@section('sales-body')

<h2>Create Purchase Order</h2>

<div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2 lg:w-1/2 justify-center">

    <h2 class="text-center text-gray-200 font-bold md:text-2xl mb-2"> * Customer Purchase Order * </h2>

    <p class="text-gray-300 flex flex-col text-[10px] mb-1">
        <span>**Retail Price: 1L = 35.00 1Gal = 129.00</span>
        <span>**Wholesale Price: 1L = 29.00 1Gal = 115.00</span>
    </p>
   

    <form method="POST" action="{{route('createcustomerpo')}}">
    @csrf
    @method('POST')
    <div class="bg-gray-200 px-4 py-4"> 

        <div class="flex flex-col">
        <h2 class="text-xs font-bold mb-1">**Customer Details</h2>
        <div class="mb-1 font-bold">
            <input type="text" placeholder="Full Name" class="h-8 w-full" name="customers_name">
        </div>

        <div class="mb-1 font-bold">
            <input type="text" placeholder="Contact Number" class="h-8 w-full" name="contact_number">
        </div>

        <div class="mb-1 font-bold">
            <input type="text" placeholder="Address" class="h-8 w-full" name="address">
        </div>

        <div class="mb-1 font-bold text-gray-500">
            <select class="h-8 w-full text-xs" name="purchase_type" id="purchase_type">
                <option value="" disabled selected>Purchase Type</option>
                <option value="Retail">Retail</option>
                <option value="Wholesale">Wholesale</option>
            </select>
        </div>

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
                    <select name="product_size[{{$allProduct->id}}]" class="w-full h-8 text-xs mb-1">
                        <option value="
                        @if($allProduct -> sku_size == 3785.41) 1Gal 

                        @elseif($allProduct -> sku_size == 1000) 1Liter 

                        @elseif($allProduct -> sku_size == 500) 500ml 

                        @endif">

                        @if($allProduct -> sku_size == 3785.41) 1Gal 

                        @elseif($allProduct -> sku_size == 1000) 1Liter 

                        @elseif($allProduct -> sku_size == 500) 500ml 

                        @endif
                    </option>
                        <option value=1 data-price-per-box=305>@if($allProduct -> sku_size == 3785.41) 1Gal(Box) @elseif($allProduct -> sku_size == 1000) 1Liter(Box) @elseif($allProduct -> sku_size == 500) 500ml(Box) @endif</option>
                    </select>
                </div>

                <div class="w-full">
                    <input type="number" name="price[{{$allProduct -> id}}]" class="w-full h-8 text-xs mb-1" placeholder="0">
                </div>

                <div class="w-full">
                    <input type="number" name="quantity[{{$allProduct -> id}}]" class="w-full h-8 text-xs" placeholder="quantity">
                </div> 
            </div>
            @endforeach
        </div>

        <div>
           
    <button type="submit" class="flex items-center justify-center bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2 text-xs">Submit</button>
    </div>

</form>
</div>

<script>
    const purchaseTypeDropDown = document.getElementById('purchase_type');
    
    purchaseTypeDropDown.addEventListener('change', function () {
        updatePrices();
    });
    
    // Add event listeners to all product size dropdowns
    document.querySelectorAll('[name^="product_size["]').forEach(function (productSizeDropdown) {
        productSizeDropdown.addEventListener('change', function () {
            updatePrices();
        });
    });
    
    function updatePrices() {
        const selectedPurchaseType = purchaseTypeDropDown.value;
    
        // Loop through each product row
        document.querySelectorAll('[name^="price["]').forEach(function (priceInput) {
            const productRow = priceInput.closest('.flex-row');
            const productId = productRow.querySelector('[name^="selected_product["]').value;
            const productSizeDropdown = productRow.querySelector('[name^="product_size["]');
            const selectedSize = productSizeDropdown.value;
    
            let pricePerBox = 0;
            
            if (productId in productSizes) {
                pricePerBox = productSizes[productId];
            }
    
            let price = 0;
    
            if (selectedPurchaseType === 'Retail') {
                price = (pricePerBox === 3785.41) ? 35 : 129;
            } else if (selectedPurchaseType === 'Wholesale') {
                price = (pricePerBox === 3785.41) ? 29 : 115;
            }
    
            // Update the price input
            priceInput.value = price;
    
            // If a specific size is selected, update the price accordingly
            if (selectedSize === '1') {
                priceInput.value = (pricePerBox === 3785.41) ? 305 : 280;
            }
        });
    }
    
    const productSizes = {
        1: 3785.41,
        2: 1000,
        3: 3785.41,
        4: 1000,
        5: 3785.41,
        6: 1000,
    };
    </script>

@endsection