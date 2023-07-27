@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold text-xl mt-2">Pull Out Form</h2>

<div class="w-full lg:w-1/2">
    
         <div class="font-bold font-2xl bg-gray-900 rounded-md p-2">
                <form  method="POST" action="{{route('addsupplierstore')}}" >
                     @csrf
                     @method('POST')
        
                     <div class="w-full">
                        <input type="text" name="pull_out_number[]" placeholder="Pull Out Number (Auto-generated)" class="mt-1 w-full text-xs" required>
                        </div>
                     <div class="w-full">
                        <input type="text" name="requested_by[]" placeholder="Requested By" class="mt-1 w-full text-xs" required>
                        </div>
                        <div class="w-full">
                            <input type="text" name="approved_by[]" placeholder="Approved By" class="mt-1 w-full text-xs" required>
                            </div>
                        <div class="flex flex-row">
                        
                            <div class="w-full">
                                <input type="text" name="item_name[]" placeholder="Item Name" class="mt-1 w-full text-xs" required>
                            </div>
                            <div class="mt-1 w-1/2">
                                 <input type="number" name="quantity[]" placeholder="Quantity" class="w-full text-xs" required>
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
                        '<input type="number" name="quantity[]" placeholder="Quantity" class="w-full text-xs" required>' +
                     '</div>' +
 
                 '</div>';
 
         itemContainer.insertAdjacentHTML('beforeend', itemHTML);
         itemCount++;
         });
     });
    </script>
     

@endsection