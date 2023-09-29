@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mt-8 font-bold border border-gray-900 rounded-sm">
  
    <h2>You Order has been confirmed. Please wait for your items within 3 days.</h2>

        <button class="p-2 bg-teal-500 hover:bg-teal-600 text-gray-200 font-bold"><a href="{{route('homepage')}}">Back to homepage</a></a></button>
   
</div>

@endsectio