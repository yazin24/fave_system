@extends('inventory.inventory_home')

@section('supplier')

   <div>
    <h2>Supplier</h2>
    <form method="POST">
      @csrf
      <select name="supplier" class="bg-teal-600">
         <option class="text-gray-200">Select From Below</option>
         <option value="" class="text-gray-200">China</option>
         <option value="" class="text-gray-200">India</option>
         <option value="" class="text-gray-200">Singapore</option>
         <option value="" class="text-gray-200">Taiwan</option>
         <option value="" class="text-gray-200">Japan</option>
         <option value="" class="text-gray-200">South Korea</option>
      </select>
    </form>
   </div>

@endsection