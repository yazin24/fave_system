@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">Add Supplier</h2>


<div class="font-bold text-red-500 font-2xl">
    @if (session('success'))
        {{ session('success') }}
    @endif
</div>

<div class="bg-gray-900 w-2/4 mt-8 p-2 mr-10">

    <div class="">

        <form  method="POST" action="{{route('addsupplierstore')}}" >
         @csrf
         @method('POST')
     
         <div class="">
         <input type="text" name="supplier_name" placeholder="Supplier Name" class="w-full" required>
         </div>
     
         <div>
             <input type="text" name="item_name[]" placeholder="Item Name" class="w-full text-xs mt-2" required>
         </div>
     
         <div id="item-container"></div>
     
         <div class="mt-4 flex flex-col gap-4">
            <div>
             <button type="button" id="add-item-button" class="bg-blue-400 hover:bg-blue-600 p-1 text-gray-200 font-bold text-sm rounded-md">Add Item</button>
            </div>
            <div>
             <button type="submit" id="add-supplier" class="bg-teal-400 hover:bg-teal-600 p-1 text-gray-200 font-bold text-sm rounded-md">Submit</button>
            </div>
         </div>
     
        </form>
     
     
     
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
     
     </div>

</div>

@endsection