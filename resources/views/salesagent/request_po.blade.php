@extends('salesagent.agent_dashboard')

@section('sales_agent-functions')

<h2>Request PO</h2>

<div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2 w-full justify-center">

    <h2 class="text-center text-gray-200 font-bold md:text-2xl"> * Enter Details Carefully * </h2>

    <form method="POST" action="">
    @csrf
    @method('POST')

        <div class="flex flex-row mb-1">
           
            <select id="supplier_name" name="supplier_name" class="w-full h-8 text-xs" required>
                <option value="" disabled selected>Choose Customer</option>
                @foreach($agentCustomers as $agentCustomer)
                <option value="{{$agentCustomer -> id}}">{{$agentCustomer -> full_name}}</option>
                @endforeach
            </select>
        </div>


        <div id="item-container" class="flex flex-col">
            @foreach($allProducts as $allProduct)
            <div class="flex flex-row justify-center">

                <div class="mt-2.5">
                    <input type="checkbox" name="selected_items[]" value="" class="">
                </div>

                <div class="w-full">
                    <input type="text" class="w-full h-8 text-xs mb-1" value="{{$allProduct -> full_name}}" readonly>
                    <input type="hidden" name="item_id[]" value="">
                </div>
                <div class="w-full">
                    <input type="text" class="w-full h-8 text-xs mb-1" value="{{$allProduct -> productVariants -> variant_name}}" readonly>
                    <input type="hidden" name="item_id[]" value="">
                </div>
                <div class="w-full">
                    <input type="text" class="w-full h-8 text-xs mb-1" value="
                        
                        @if($allProduct -> sku_size == 3785.41)
                        1Gallon
                        @elseif($allProduct -> sku_sie == 1000.00)
                        1Liter
                        @elseif($allProduct -> sku_size == 450.00)
                        450ml
                        @endif
                        
                    " readonly>
                    <input type="hidden" name="item_id[]" value="">
                </div>
                <div class="w-full">
                    <input type="text" class="w-full h-8 text-xs mb-1" value="{{$allProduct -> default_price}}" readonly>
                    <input type="hidden" name="item_id[]" value="">
                </div>

                <div class="w-full">
                    <input type="number" name="quantity[]" class="w-full h-8 text-xs" placeholder="quantity">
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
