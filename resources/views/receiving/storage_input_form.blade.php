@extends('receiving.receiving_home')

@section('receiving-body')

        <h2 class="font-bold md:text-xl mt-2">Input Form</h2>
        <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">
                <form method="POST" action="{{route('addproductsku')}}">
                    @csrf
                <div class="bg-gray-200 px-4 py-4">
                    <div class="flex flex-wrap justify-between md:mx-8">
                   
                  
                </div>
                <div class="mt-4 font-bold">
                   <h2></h2>
                    <div>
                        <label>Choose Action</label>
                        <select id="" name="action" class="w-full text-gray-500 text-xs h-8" required>
                            <option value="" disabled selected>-</option>
                            <option value="Add">Add</option>
                            <option value="Subtract">Subtract</option>
                            
                        </select>
                    </div>
                    <div>
                        <label>Put Quantity</label>
                        <input type="number" name="sku_quantity" class="h-8 w-full">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="p-1 bg-teal-500 text-gray-200 font-bold hover:bg-teal-600 rounded-md shadow-md">Submit</button>
                    </div>
                </div>
                </div>
                </form>
             </div>
        
        </div>

@endsection