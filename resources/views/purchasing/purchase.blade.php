@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full mx-auto">
    
         <h2 class="font-bold ml-1">Choose a supplier</h2>
             <form method="POST" action="{{route('purchaseshowsupplieritems')}}" class="mb-1">
                    @csrf
                    @method('POST')
                    <div class="flex flex-row">
                        <div class="mr-2">
                            <select id="supplier_id" name="supplier_id" class="h-10 text-xs" required>
                                <option value="" disabled selected>Supplier Name</option>
                                @foreach($suppliers as $supplier)
                                <option value="{{$supplier -> id}}">{{$supplier -> supplier_name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="flex items-center">
                                <button type="submit" id="show-item-button" class="font-bold bg-teal-400 text-gray-100 p-0.5 rounded-md hover:bg-teal-600 text-[10px] shadow-md mt-1">Enter</button>
                            </div>
                        </div>
             </form>
    
</div>

    @if(isset($supplierItems))
    <div class="border border-gray-900 rounded-sm shadow-lg bg-gray-900 p-1 w-full lg:w-3/4 justify-center font-bold">
        <h2 class="flex justify-center text-gray-200 text-sm">Purchase Order</h2>
        <form method="POST" action="{{route('purchaseorderstore', ['id' => $supplierNameForPurchase -> id] )}}">
        @csrf
        @method('POST')
            <div class="flex flex-row mt-1">
                {{-- <input type="text" id="supplier_name" name="supplier_name" placeholder="Supplier Name" class="w-1/2" required> --}}

                <input type="number" id="supplier_credit" name="po_number" placeholder="PO Number (auto)" class="w-1/2 h-6 text-xs"  required readonly>

                <input type="number" id="supplier_credit" name="supplier_credit" placeholder="Available Credit: {{$supplierCredit ?? 0}}" class="w-1/2 h-6 text-xs"  required readonly>
            </div>

            <div class="flex flex-row">

                <select id="supplier_name" name="supplier_name" class="w-1/2 h-8 text-xs" required>
    
                    <option value="{{$supplierNameForPurchase -> id}}">{{$supplierNameForPurchase -> supplier_name}}</option>
    
                    </select>

                    <input type="text" id="requested_by" name="requested_by" placeholder="Requested By" class="h-8 w-1/2 text-xs" required>
                {{-- <select id="requested_by" name="requested_by" class="w-1/2 h-8 text-xs mb-1" required>
                    <option value="" disabled selected>Requested By</option>
                    <option value="Fave">Fave</option>
                    <option value="Rodel">Rodel</option>
                    <option value="Theresa">Theresa</option>
                    <option value="Calvin">Calvin</option>
                    <option value="Nath">Nath</option>
                </select> --}}

                {{-- <input type="text" id="prepared_by" name="prepared_by" placeholder="Prepared By" class="w-1/2 text-xs" required> --}}
            </div>

            <div class="flex flex-row mb-1">
                {{-- <input type="text" id="approved_by" name="approved_by" placeholder="Approved By" class="w-1/2 text-xs" required> --}}
                <select id="payment_term" name="payment_term" class="w-1/2 h-8 text-xs mb-1" required>
                    <option value="" disabled selected>Payment Term</option>
                <option value=3>3 Days</option>
                <option value=7>7 Days</option>
                <option value=15>15 Days</option>
                <option value=30>30 Days</option>
                <option value=7>7 Days PDC</option>
                <option value=15>15 Days PDC</option>
                <option value=30>30 Days PDC</option>
                
                </select>

                <select id="mode_of_payment" name="mode_of_payment" class="w-1/2 h-8 text-xs" required>
                    <option value="" disabled selected>Mode of Payment</option>
                    <option value="cash">Cash</option>
                    <option value="bank transfer">Bank Transfer</option>
                    <option value="cheque">Cheque</option>
                    <option value="gcash">Gcash</option>
                    <option value="paymaya">Paymaya</option>
                    <option value="BDO Deposit">BDO Deposit</option>
                    <option value="BPI Deposit">BPI Deposit</option>
                    <option value="CBC Deposit">CBC Deposit</option>
                    <option value="Security Bank Deposit">Security Bank Deposit</option>
                    <option value="China Bank Deposit">China Bank Deposit</option>
                </select>
                
            </div>

    
            <div id="item-container" class="flex flex-col">
             @foreach($supplierItems -> sortBy('item_name') as $supplierItem)

                <div class="flex flex-row justify-center">

                    <div class="mt-1">
                        <input type="checkbox" name="selected_items[]" value="{{$supplierItem -> id}}" class="">
                    </div>

                    <div class="w-full">
                        <input type="text" class="w-full h-7 text-xs" value="{{$supplierItem ->item_name}}" readonly>
                        <input type="hidden" name="item_id[{{$supplierItem->id}}]" value="{{$supplierItem->item_id}}">
                    </div>

                    <div class="w-full">
                        <input type="number" name="quantity[{{$supplierItem -> id}}]" class="w-full h-7 text-xs" placeholder="Quantity">
                    </div> 

                    <div class="w-full">
                        <select id="quantity_unit" name="item_unit[{{$supplierItem -> id}}]" class="w-full h-7 text-xs py-0">
                            <option value="{{$supplierItem -> item_unit}}">{{$supplierItem -> item_unit}}</option>
                        </select>
                    </div>

                    <div class="w-full">
                        <input type="number" name="unit_price[{{$supplierItem -> id}}]" class="w-full h-7 text-xs" placeholder="Unit Price" value="{{$supplierItem -> default_price}}">
                    </div>
                    <div class="w-full">
                        <input type="number" name="amount[{{$supplierItem -> id}}]" class="w-full h-7 text-xs" placeholder="Amount (auto)" readonly>
                    </div>
                </div>
                @endforeach
            </div>

            <div>
        <button type="submit" id="add-item" class="flex items-center justify-center bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600 my-2 text-xs">Submit</button>
        </div>

    </form>
    </div>
    @endif
   
</div>
@endsection