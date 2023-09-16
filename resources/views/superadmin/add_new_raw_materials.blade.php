@extends('superadmin.superadmin_home')

@section('superadmin-body')

@if($errors -> any())
<div class="text-red-600 font-bold text-xs">
    <ul>
        @foreach($errors -> all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="font-bold">
  <h2>Add New Raw Materials</h2>
  <div class="bg-gray-900 p-1 rounded-sm w-full md:w-1/2 lg:w-1/3">
    <div class="bg-gray-200 p-1">
        <form method="POST" action="{{route('addnewrawmaterials')}}">
            @csrf
            <input type="text" class="rounded-sm w-full text-xs mb-1 h-8" placeholder="Item Name" name="item_name">
            <input type="number" step="0.01" class="rounded-sm w-full text-xs mb-1 h-8" placeholder="Default Price" name="default_price">
            <div class="flex flex-row">
                <input type="text" class="rounded-sm w-1/2 text-xs mb-1 h-8" placeholder="Quantity" name="quantity">
            <select class="h-8 text-xs mb-1 w-1/2" name="item_unit">
                <option value="" selected disabled>-----</option>
                <option value="kg">kg</option>
                <option value="liters">liters</option>
                <option value="grams">grams</option>
                <option value="pcs">pcs</option>
                <option value="ml">ml</option>
                <option value="cm">cm</option>
            </select>
            </div>
            
            <button type="submit" class="flex justify-end text-xs p-1 bg-teal-500 hover:bg-teal-600 text-gray-200 rounded-sm shadow-sm"><a>Submit</a></button>
        </form>
       
    </div>
    
  </div>
</div>


@endsection