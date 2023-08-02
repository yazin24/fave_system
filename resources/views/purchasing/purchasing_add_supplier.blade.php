@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full lg:w-1/2">
    
        <h2 class="font-bold md:text-xl mb-4">Add Supplier</h2>
        
             <div class="font-bold font-2xl bg-gray-900 rounded-md p-2">
                    <form  method="POST" action="{{route('addsupplierstore')}}" >
                         @csrf
                         @method('POST')
     
                         <div class="">
                            <input type="text" name="supplier_name" placeholder="Supplier Name" class="w-full text-xs" required>
                         </div>

                         <div class="mt-1">
                            <input type="text" name="supplier_address" placeholder="Address" class="w-full text-xs" required>
                         </div>

                         <div class="mt-1">
                            <input type="text" name="contact_number" placeholder="Contact Number" class="w-full text-xs" required>
                         </div>
                         <div class="mt-1">
                            <input type="text" name="tel_number" placeholder="Telephone Number" class="w-full text-xs" required>
                         </div>
                         <div class="mt-1">
                            <input type="text" name="contact_person" placeholder="Contact Person" class="w-full text-xs" required>
                         </div>
                         <div class="mt-1">
                            <input type="text" name="viber_account" placeholder="Viber" class="w-full text-xs" required>
                         </div>
                         <div class="mt-1">
                            <input type="text" name="supplier_email" placeholder="Email" class="w-full text-xs" required>
                         </div>
                         <div class="mt-1">
                            <input type="text" name="supplier_credit_limit" placeholder="Credit Limit" class="w-full text-xs" required>
                         </div>
            
                        <div class="flex flex-row">
                            <div class="w-full">
                            <input type="text" name="item_name[]" placeholder="Item Name" class="mt-1 w-full text-xs" required>
                            </div>
                            <div class="mt-1 w-1/2">
                                <select id="" name="item_unit[]" class="w-full text-gray-500 text-xs">
                                    <option value="" disabled selected>Unit Measurement</option>
                                    <option value="kg">kg</option>
                                    <option value="liters">liters</option>
                                    <option value="pcs">pcs</option>
                                    <option value="g">g</option>
                                    <option value="ml">ml</option>
                                    <option value="cm">cm</option>
                                </select>
                            </div>
                         </div>
                                    <div id="item-container" class="text-gray-500 text-xs">
                                    </div>
                                         <div class="mt-2 flex flex-col gap-4">
                                            <div>
                                                <button type="button" id="add-item-button" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md text-xs">Add Item</button>
                                            </div>
                                                <div>
                                                    <button type="submit" id="add-supplier" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md text-xs">Submit</button>
                                                </div> 
                                         </div>
                                    </div>
                    </form>
              </div>                    
 </div> 
     
        <script>
         document.addEventListener('DOMContentLoaded', function(){
             var addItemButton = document.getElementById('add-item-button');
             var itemContainer = document.getElementById('item-container');
             var itemCount = 1;
     
             addItemButton.addEventListener('click', function(){
                 var itemHTML = '<div class="">' + 
     
                     '<div class="flex flex-row">' +
                        '<div class="w-full">' + 
                         '<input type="text" id="item_name_' + itemCount + '" name="item_name[]" class="w-full text-gray-500 text-xs" placeholder="Item Name" required>' + 
                         '</div>' +
                         '<div class=" w-1/2">' + 
                           ' <select id="" name="item_unit[]" class="w-full text-xs">' +
                                   '<option value="" disabled selected>Unit Measurement</option>' +
                                    '<option value="kg">kg</option>' +
                                    '<option value="liters">liters</option>' +
                                    '<option value="pcs">pcs</option>' +
                                    '<option value="kg">g</option> ' + 
                                    '<option value="liters">ml</option>' + 
                                    '<option value="pcs">cm</option>' +
                                '</select>' + 
                                '</div>' + 
                         '</div>' +
     
                     '</div>';
     
             itemContainer.insertAdjacentHTML('beforeend', itemHTML);
             itemCount++;
             });
         });
        </script>
         
    

@endsection