@extends('admin.admin_home')

@section('admin_purchase_order_edit')


<h2 class="font-bold text-xl mb-2 ml-1">Edit Purchase Order</h2>

<div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2">
<form method="POST" action="{{route('purchaseorderstore')}}">
    @csrf
    @method('POST')
    <div class="flex flex-row mt-4 mb-3">
        <input type="text" name="supplier_name" placeholder="Supplier Name" value="" class="w-1/2" required>

        <h2>{{optional($allPurchaseOrder -> purchaseOrderSupplier -> supplier_name)}}</h2>
    </div>
    <div class="flex flex-row mt-4 mb-3">

        <input type="text" id="requested_by" name="requested_by" placeholder="Requested By" value="{{$allPurchaseOrder -> purchaseOrderCredentials -> requested_by}}" class="w-1/2 text-xs" required>

        {{-- <select id="requested_by" name="requested_by" class="w-1/2" required>
            <option value="" disabled selected>Select</option>
            <option value="Fave">Fave</option>
            <option value="Rodel">Rodel</option>
            <option value="Theresa">Theresa</option>
            <option value="Calvin">MJ</option>
            <option value="Nath">Nath</option>
        </select> --}}

        <input type="text" id="prepared_by" name="prepared_by" placeholder="Prepared By" value="{{$allPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}" class="w-1/2 text-xs" required>

        {{-- <select id="prepared_by" name="prepared_by" class="w-1/2" required>
            <option value="" disabled selected>Select</option>
            <option value="Joy">Joy</option>
            <option value="Jane">Jane</option>
            <option value="MJ">MJ</option>
        </select> --}}
    </div>

    <div class="flex flex-row mt-4 mb-3">

        <input type="text" id="approved_by" name="approved_by" placeholder="Approved By" value="{{$allPurchaseOrder -> purchaseOrderCredentials -> approved_by}}" class="w-1/2 text-xs" required>
        {{-- <select id="approved_by" name="approved_by" class="w-1/2" required>
            <option value="" disabled selected>Select</option>
            <option value="Joy">Sir Mike</option>
            <option value="Jane">Sir Calvin</option>
            <option value="MJ">Sir Nath</option>
        </select> --}}
    </div>

    <div class="flex flex-row mb-3 mr-2 w-full">
        <div class="flex-1">
            <input type="text" id="item_name" name="item_name[]" placeholder="Item Name" class="w-full" required>
        </div>
        <div class="flex-1">
            <input type="number" id="quantity" name="quantity[]" placeholder="Quantity" class="w-full" required>
        </div>
        <div class="flex-1">
            <input type="number" id="unit_price" name="unit_price[]" placeholder="Unit Price" class="w-full" required>
        </div>
        <div class="flex-1">
            <input type="number" id="amount" name="amount[]" placeholder="Amount" class="w-full" required>
        </div>
    </div>

    <div id="item-container"></div>
    
    <div class="flex flex-col space-between">
        <div>
    <button type="button" id="add-item-button" class="bg-blue-400 text-gray-100 p-1 rounded-md hover:bg-blue-600 my-2 text-xs">Add Item</button>
        </div>

        <div>
    <button type="submit" id="add-item" class="bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2">Submit</button>
    </div>

    </div>
</form>

</div>

@endsection