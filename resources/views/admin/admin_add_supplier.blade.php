@extends('admin.admin_home')

@section('admin-body')

<div class="w-full mx-auto">
     {{-- <form class="bg-indigo shadow-md rounded px-8 pt-6 pb-8 mb-4"> --}}
        <h2 class="font-bold text-xl mb-4">Add Supplier</h2>

                <div class="font-bold text-red-500 font-2xl">
                    @if (session('success'))
                    {{ session('success') }}
                    @endif
                </div>

                                                        {{-- <div class="bg-gray-900 w-2/4 mt-8 p-2 mr-10"> --}}


             <div class="">

                    <form  method="POST" action="{{route('addsupplierstore')}}" >
                         @csrf
                         @method('POST')
     
                       <div class="">
                            <input type="text" name="supplier_name" placeholder="Supplier Name" class="" required>
                       </div>
     
                       <div>
                            <input type="text" name="item_name[]" placeholder="Item Name" class="mt-2" required>
                       </div>
                       <div id="item-container" class="mb-4">
                       <div class="mt-2 flex gap-4">
                           <div>
                              <button type="button" id="add-item-button" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md">Add Item</button>
                           </div>
                       <div>
                        </div>
                              <button type="submit" id="add-supplier" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md">Submit</button>
                       </div>
                    </form>
           </div>
     
        
     
     
     
        <script>
         document.addEventListener('DOMContentLoaded', function(){
             var addItemButton = document.getElementById('add-item-button');
             var itemContainer = document.getElementById('item-container');
             var itemCount = 1;
     
             addItemButton.addEventListener('click', function(){
                 var itemHTML = '<div class="">' + 
     
                     '<div class="flex-1">' +
                         '<input type="text" id="item_name_' + itemCount + '" name="item_name[]" class="w-full text-xs" placeholder="Item Name" required>' +
                         '</div>' +
     
                     '</div>';
     
             itemContainer.insertAdjacentHTML('beforeend', itemHTML);
             itemCount++;
             });
         });
        </script>
     
    
     {{-- </form> --}}
</div>

@endsection