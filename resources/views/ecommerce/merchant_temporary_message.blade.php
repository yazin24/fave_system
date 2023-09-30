@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-12 md:mt-24">
    
    <div class="flex flex-col m-8 w-1/2 md:w-1/4 border bg-gray-200 p-2 rounded-md shadow-md">
  <div class="flex flex-col jusitfy-center mb-8 text-red-500">
    <h2>Oops!</h2>
    <h2>Sorry, this service is temporarily unavailable. Please try again later.</h2>
  </div>
    
    <div>
        <button class="text-red-500 hover:underline"><a href="{{route('homepage')}}">Ok</i></a></a></button>
    </div>
    </div>    
   
</div>

@endsection