@extends('purchasing.purchasing_home')

@section('purchasing-body')

<div class="w-full lg:w-1/2">
    
        <h2 class="font-bold text-xl mb-4">Add Supplier</h2>
        
             <div class="font-bold font-2xl bg-gray-900 rounded-md p-2">
                    <form  method="POST" action="{{route('addsupplierstore')}}" >
                         @csrf
                         @method('POST')
     
                         <div class="">
                            <input type="text" name="supplier_name" placeholder="Supplier Name" class="w-full" required>
                         </div>
            
                        <div>
                            <input type="text" name="item_name[]" placeholder="Item Name" class="mt-2 w-full" required>
                         </div>
                                    <div id="item-container" class="mt-2">
                                    </div>
                                         <div class="mt-2 flex flex-col gap-4">
                                            <div>
                                                <button type="button" id="add-item-button" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md">Add Item</button>
                                            </div>
                                                <div>
                                                    <button type="submit" id="add-supplier" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md">Submit</button>
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
     
                     '<div class="flex-1">' +
                         '<input type="text" id="item_name_' + itemCount + '" name="item_name[]" class="w-full" placeholder="Item Name" required>' +
                         '</div>' +
     
                     '</div>';
     
             itemContainer.insertAdjacentHTML('beforeend', itemHTML);
             itemCount++;
             });
         });
        </script>
         
    

@endsection