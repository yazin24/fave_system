@extends('inventory.inventory_home')

@section('add_item')

   <div>
    <div class="flex flex-col border p-4 shadow-lg bg-gray-500 rounded-md w-70 justify-center items-center">
      <h2 class="text-gray-200 font-bold">Add Item</h2>
    <form method="POST" action="">
      @csrf
      <div class="mb-2">
      <input class="w-56" type="text" placeholder="Stock Name">
      </div>
      <div class="mb-2">
      <input class="w-56" type="number" placeholder="Beginning Stock">
       </div>
      <div class="mb-2">
      <input class="w-56" type="number" placeholder="New Purchase">
      </div>
      <div class="mb-2">
      <input class="w-56" type="number" placeholder="Output">
   </div>
      <div class="mb-2">
      <input class="w-56" type="number" placeholder="Stock Name">
      </div>
      <div>
         <input type="submit" class="bg-teal-400 text-gray-100 p-1 rounded-md hover:bg-teal-600">
      </div>
    </form>
    </div>
   </div>

@endsection