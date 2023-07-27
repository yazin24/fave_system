@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full mx-auto">
    
         <h2 class="font-bold text-xl mb-4 ml-1">Choose a supplier</h2>
             <form method="POST" action="{{route('purchaseshowsupplieritems')}}">
                    @csrf
                    @method('POST')
                    <div class="flex flex-row">
                        <div class="mr-4">
                            <select id="supplier_id" name="supplier_id" class="text-sm" required>
                                <option value="" disabled selected>Supplier Name</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier -> id}}">{{$supplier -> supplier_name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="flex items-center">
                                <button type="submit" id="show-item-button" class="bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2 text-sm shadow-md">Enter</button>
                            </div>
                        </div>
             </form>
    
</div>

    @if(isset($supplierItems))
    <div class="border border-gray-900 rounded-md shadow-lg bg-gray-900 p-2 w-full justify-center">

        <h2 class="text-center text-gray-200 font-bold text-2xl"> * Purchase Order * </h2>

        <form method="POST" action="{{route('purchaseorderstore', ['id' => $supplierNameForPurchase -> id] )}}">
        @csrf
        @method('POST')
            <div class="flex flex-row mt-4">
                {{-- <input type="text" id="supplier_name" name="supplier_name" placeholder="Supplier Name" class="w-1/2" required> --}}

                <input type="number" id="supplier_credit" name="po_number" placeholder="PO Number (auto)" class="w-1/2 h-8 text-xs mb-1"  required readonly>
              
                

                <input type="number" id="supplier_credit" name="supplier_credit" placeholder="Available Credit: {{$supplierCredit ?? 0}}" class="w-1/2 h-8 text-xs mb-1"  required readonly>
            </div>

            <div class="flex flex-row">
                {{-- <input type="text" id="requested_by" name="requested_by" placeholder="Requested By" class="w-1/2 text-xs" required> --}}

                <select id="supplier_name" name="supplier_name" class="w-1/2 h-8 text-xs" required>
    
                    <option value="{{$supplierNameForPurchase -> supplier_name}}">{{$supplierNameForPurchase -> supplier_name}}</option>
    
                    </select>

                <select id="requested_by" name="requested_by" class="w-1/2 h-8 text-xs mb-1" required>
                    <option value="" disabled selected>Requested By</option>
                    <option value="Fave">Fave</option>
                    <option value="Rodel">Rodel</option>
                    <option value="Theresa">Theresa</option>
                    <option value="Calvin">Calvin</option>
                    <option value="Nath">Nath</option>
                </select>

                {{-- <input type="text" id="prepared_by" name="prepared_by" placeholder="Prepared By" class="w-1/2 text-xs" required> --}}
            </div>

             <div class="flex flex-row">
                {{-- <input type="text" id="approved_by" name="approved_by" placeholder="Approved By" class="w-1/2 text-xs" required> --}}
                <select id="prepared_by" name="prepared_by" class="w-1/2 h-8 text-xs mb-1" required>
                    <option value="" disabled selected>Prepared By</option>
                <option value="Joy">Joy</option>
                <option value="Jane">Jane</option>
                <option value="MJ">MJ</option>
                </select>

                <select id="approved_by" name="approved_by" class="w-1/2 h-8 text-xs" required>
                    <option value="" disabled selected>Approved By</option>
                    <option value="Sir Mike">Sir Mike</option>
                    <option value="Sir Calvin">Sir Calvin</option>
                    <option value="Sir Nath">Sir Nath</option>
                </select>
                
            </div>

            <div class="flex flex-row mb-3">
                {{-- <input type="text" id="approved_by" name="approved_by" placeholder="Approved By" class="w-1/2 text-xs" required> --}}
                <select id="credit_term" name="credit_term" class="w-1/2 h-8 text-xs mb-1" required>
                    <option value="" disabled selected>Credit Term</option>
                    <option value=1>sample Days</option>
                <option value=3>3 Days</option>
                <option value=7>1 Week</option>
                <option value=14>2 Weeks</option>
                <option value=30>1 Month</option>
                </select>

                <select id="payment_term" name="payment_term" class="w-1/2 h-8 text-xs" required>
                    <option value="" disabled selected>Payment Term</option>
                    <option value="cash">Cash</option>
                    <option value="bank transfer">Bank Transfer</option>
                    <option value="cheque">Cheque</option>
                    <option value="gcash">Gcash</option>
                    <option value="paymaya">Paymaya</option>
                </select>
                
            </div>

    
            <div id="item-container" class="flex flex-col">
             @foreach($supplierItems as $supplierItem)

                <div class="flex flex-row justify-center">

                    <div class="mt-2.5">
                        <input type="checkbox" name="selected_items[]" value="{{$supplierItem -> id}}" class="">
                    </div>

                    <div class="w-full">
                        <input type="text" name="item_name[{{$supplierItem -> id}}]" class="w-full h-8 text-xs mb-1" placeholder="Item Name" value="{{$supplierItem->item_name}}" required>
                    </div>

                    <div class="w-full">
                        <input type="number" name="quantity[{{$supplierItem -> id}}]" class="w-full h-8 text-xs" placeholder="Quantity">
                    </div> 

                    <div class="w-full">
                        <select id="quantity_unit" name="quantity_unit[{{$supplierItem -> id}}]" class="w-full h-8 text-xs">
                            <option value="{{$supplierItem -> item_unit}}">{{$supplierItem -> item_unit}}</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <input type="number" name="unit_price[{{$supplierItem -> id}}]" class="w-full h-8 text-xs" placeholder="Unit Price">
                    </div>
                    <div class="w-full">
                        <input type="number" name="amount[{{$supplierItem -> id}}]" class="w-full h-8 text-xs" placeholder="Amount (auto)" readonly>
                    </div>
                </div>
                @endforeach
            </div>

            <div>
        <button type="submit" id="add-item" class="flex items-center justify-center bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2 text-sm">Submit</button>
        </div>

    </form>
    </div>
    @endif
   
</div>
@endsection