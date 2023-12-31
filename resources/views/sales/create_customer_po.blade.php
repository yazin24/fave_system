@extends('sales.sales_home')

@section('sales-body')

@if($errors -> any())
<div class="text-red-600 font-bold text-xs">
    <ul>
        @foreach($errors -> all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="border border-gray-900 rounded-sm shadow-lg bg-gray-900 p-1 lg:w-1/2 justify-center">

    {{-- <p class="text-gray-300 flex flex-col text-[10px] mb-1">
        <span>**Retail Price: 1L = 35.00 1Gal = 129.00</span>
        <span>**Wholesale Price: 1L = 29.00 1Gal = 115.00</span>
    </p> --}}
   

    <form method="POST" action="{{route('createcustomerpo')}}">
    @csrf
    @method('POST')
    <div class="bg-gray-200 px-4 pb-1 pt-0.5 font-bold"> 

        <h2 class="text-center text-gray-800 font-bold"> * Customer Purchase Order * </h2>

        <div class="flex flex-col">
        
        <div class="mb-0.5 font-bold">
            <input type="text" placeholder="Full Name" class="h-6 w-full text-xs" name="customers_name">
        </div>

        <div class="mb-0.5 font-bold">
            <input type="text" placeholder="Contact Number" class="h-6 w-full text-xs" name="contact_number">
        </div>

        <div class="mb-0.5 font-bold">
            <input type="text" placeholder="Address" class="h-6 w-full text-xs" name="address">
        </div>

        <div class="mb-1 mt-1 font-bold text-gray-500">
            <select class="h-8 w-1/2 text-xs py-0" name="purchase_type" id="purchase_type" required>
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
                    <input type="text" class="w-full h-8 text-xs" value="{{$allProduct -> full_name}}" readonly>
                    <input type="hidden" name="product_id[{{$allProduct -> id}}]" value="{{$allProduct -> id}}">
                </div>

                <div class="w-full">
                    <input type="text" class="w-full h-8 text-xs" value="@if($allProduct -> productVariants -> variant_name === 'Calamansi') C @elseif($allProduct -> productVariants -> variant_name === 'Honey Lemon') HL @elseif($allProduct -> productVariants -> variant_name === 'Fresh Antibac') FA @endif" readonly>
                </div>

                <div class="w-full">
                    <select name="product_size[{{$allProduct->id}}]" class="w-full h-8 text-xs py-0">
                        <option value="0">

                        @if($allProduct -> sku_size == 3785.41) 1Gal 

                        @elseif($allProduct -> sku_size == 1000) 1Liter 

                        @elseif($allProduct -> sku_size == 900) 900g 

                        @elseif($allProduct -> sku_size == 200) 200ml

                        @endif
                    </option>
                        <option value=1 data-price-per-box=305>
                            @if($allProduct -> sku_size == 3785.41) 1Gal(Box) 

                            @elseif($allProduct -> sku_size == 1000) 1Liter(Box) 

                            @elseif($allProduct -> sku_size == 900) 900g(Box) 

                            @elseif($allProduct -> sku_size == 200) 200ml(Box)
                            @endif
                        </option>
                    </select>
                </div>

                <div class="w-full">
                    <input type="number" name="price[{{$allProduct -> id}}]" class="w-full h-8 text-xs" placeholder="0">
                </div>

                <div class="w-full">
                    <input type="number" name="quantity[{{$allProduct -> id}}]" class="w-full h-8 text-xs" placeholder="quantity">
                </div> 
            </div>
            @endforeach
        </div>

        <div>
           
    <button type="submit" class="flex items-center justify-center bg-teal-400 text-gray-100 p-1 shadow-md rounded-sm hover:bg-teal-600 my-2 text-xs">Submit</button>
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
            pricePerBox = productSizes[productId].pricePerBox;
        }

        let price = 0;

        if (selectedPurchaseType === 'Retail') {
            price = (selectedSize === '1') ? pricePerBox : productSizes[productId].retailPrice;
        } else if (selectedPurchaseType === 'Wholesale') {
            price = (selectedSize === '1') ? pricePerBox : productSizes[productId].wholesalePrice;
        }

        // Update the price input
        priceInput.value = price;
    });
}

    const productSizes = {
    1: {
        size: 200, 
        retailPrice: 25,
        wholesalePrice: 18,
        pricePerBox: 864,
    },
    2: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    3: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    4: {
        size: 3785.41, 
        retailPrice: 135,
        wholesalePrice: 129,
        pricePerBox: 516,
    },
    5: {
        size: 200, 
        retailPrice: 25,
        wholesalePrice: 18,
        pricePerBox: 864,
    },
    6: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    7: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    8: {
        size: 3785.41, 
        retailPrice: 135,
        wholesalePrice: 129,
        pricePerBox: 516,
    },
    9: {
        size: 200, 
        retailPrice: 25,
        wholesalePrice: 18,
        pricePerBox: 864,
    },
    10: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    11: {
        size: 1000, 
        retailPrice: 99,
        wholesalePrice: 85,
        pricePerBox: 850,
    },
    12: {
        size: 3785.41, 
        retailPrice: 135,
        wholesalePrice: 129,
        pricePerBox: 516,
    },
    
   

    // Add entries for other products with their respective sizes and prices
};
    
    // const productSizes = {
    //     1: 200.00,
    //     2: 1000.00,
    //     3: 1000.00,
    //     4: 3785.41,
    //     5: 200.00,
    //     6: 1000.00,
    //     7: 1000.00,
    //     8: 3785.41,
    //     9: 200.00,
    //     10: 1000.00,
    //     11: 1000.00
    //     12: 3785.41,
    // };
    </script>

@endsection