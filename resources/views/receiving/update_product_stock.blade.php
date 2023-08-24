@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">View P.O</h2>

<div class="mt-2 md:mt-4">
    <form method="POST" action="">
        @csrf
        @method('PUT')
    <div class="bg-gray-900 rounded-md p-2 md:px-4 md:py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-4"> 
                <div>
                    <h2 class="text-xs text-gray-800 font-bold">SKU NAME: <span class="text-blue-600 font-bold"></span></h2>
                    <h2 class="text-xs text-gray-800 font-bold">VARIANT: <span class="text-red-700 font-bold capitalize"></span></h2>
                    <h2 class="text-xs text-gray-800 font-bold">SIZE: <span class="text-red-700 font-bold capitalize"></span></h2>
                </div>
         <div>
                 <button type="submit" class="bg-teal-400 hover:bg-teal-600 p-1 mt-2 rounded-sm text-gray-200 text-sm w-full font-bold">
                 Update Stocks
                </button>
         </div>
    </form>

</div>


@endsection