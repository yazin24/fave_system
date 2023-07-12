@extends('purchasing.purchasing_home')

@section('purchasing-body')


    <h2 class="font-bold text-xl mb-4 ml-1">Choose a supplier</h2>

    <div class="flex flex-row">

        <form method="POST" action="{{route('purchaseshowsupplieritems')}}">
            @csrf
            @method('POST')
        <div class="mr-4">
                <select id="supplier_id" name="supplier_id" class="" required>
                <option value="" disabled selected>Supplier Name</option>
                @foreach($suppliers as $supplier)
                <option value="{{$supplier -> id}}">{{$supplier -> supplier_name}}</option>
                @endforeach
                </select>
        </div>

        <div>
            <button type="submit" id="show-item-button" class="bg-green-400 text-gray-100 p-2 rounded-md hover:bg-blue-600 my-2 text-sm shadow-md">Enter</button>
        </div>

        </form>
    </div>

    @if(isset($supplierItems))
    <div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2">

        <h2 class="text-center text-gray-200 font-bold text-2xl"> * Purchase Order * </h2>

        <form method="POST" action="{{route('purchaseorderstore')}}">
        @csrf
        @method('POST')
            <div class="flex flex-row mt-4 mb-3">
                {{-- <input type="text" id="supplier_name" name="supplier_name" placeholder="Supplier Name" class="w-1/2" required> --}}

                <select id="supplier_name" name="supplier_name" class="w-1/2" required>
    
                <option value="{{$supplierNameForPurchase -> supplier_name}}">{{$supplierNameForPurchase -> supplier_name}}</option>
              
                </select>

                <input type="number" id="po_number" name="po_number" placeholder="PO Number (auto)" class="w-1/2"  required readonly>
            </div>

            <div class="flex flex-row mt-4 mb-3">
                {{-- <input type="text" id="requested_by" name="requested_by" placeholder="Requested By" class="w-1/2 text-xs" required> --}}
                <select id="requested_by" name="requested_by" class="w-1/2" required>
                    <option value="" disabled selected>Requested By</option>
                    <option value="Fave">Fave</option>
                    <option value="Rodel">Rodel</option>
                    <option value="Theresa">Theresa</option>
                    <option value="Calvin">Calvin</option>
                    <option value="Nath">Nath</option>
                </select>

                {{-- <input type="text" id="prepared_by" name="prepared_by" placeholder="Prepared By" class="w-1/2 text-xs" required> --}}

                <select id="prepared_by" name="prepared_by" class="w-1/2" required>
                        <option value="" disabled selected>Prepared By</option>
                    <option value="Joy">Joy</option>
                    <option value="Jane">Jane</option>
                    <option value="MJ">MJ</option>
                </select>
            </div>

             <div class="flex flex-row mt-4 mb-3">
                {{-- <input type="text" id="approved_by" name="approved_by" placeholder="Approved By" class="w-1/2 text-xs" required> --}}
                <select id="approved_by" name="approved_by" class="w-1/2" required>
                    <option value="" disabled selected>Approved By</option>
                    <option value="Sir Mike">Sir Mike</option>
                    <option value="Sir Calvin">Sir Calvin</option>
                    <option value="Sir Nath">Sir Nath</option>
                </select>
            </div>

    
            <div id="item-container" class="flex flex-col">
             @foreach($supplierItems as $supplierItem)

                <div class="flex flex-row">

                    <div class="mt-5">
                        <input type="checkbox" name="selected_items[]" value="{{$supplierItem -> id}}">
                    </div>

                    <div>
                        <input type="text" name="item_name[{{$supplierItem -> id}}]" class="w-full" placeholder="Item Name" value="{{$supplierItem->item_name}}" required>
                    </div>

                    <div>
                        <input type="number" name="quantity[{{$supplierItem -> id}}]" class="w-full" placeholder="Quantity">
                    </div>

                    <div>
                        <input type="number" name="unit_price[{{$supplierItem -> id}}]" class="w-full" placeholder="Price">
                    </div>
                    <div>
                        <input type="number" name="amount[{{$supplierItem -> id}}]" class="w-full" placeholder="Amount (auto)" readonly>
                    </div>
                </div>
                @endforeach
            </div>

        <button type="submit" id="add-item" class="bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2">Submit</button>

    </form>
    </div>
    @endif
   
</div>
@endsection