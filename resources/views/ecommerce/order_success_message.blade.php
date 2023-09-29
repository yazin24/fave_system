@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-12 md:mt-24">
    
    <div class="flex flex-col m-8 w-1/2 md:w-1/4 border bg-gray-200 p-2 rounded-md shadow-md">
  <div class="flex jusitfy-center mb-8">
    <h2>YOUR ORDER HAS BEEN CONFIRMED. PLEASE WAIT FOR YOUR ITEM(S) WITHIN 3 DAYS.</h2>
  </div>
    
    <div>
        <button class="p-2 bg-teal-500 hover:bg-teal-600 text-gray-200 font-bold rounded-sm text-xs shadow-md"><a href="{{route('homepage')}}">BACK TO HOMEPAGE</a></a></button>
    </div>
    </div>    
   
</div>

@endsection