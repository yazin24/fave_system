@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Products List</h2>

<button class="bg-teal-400 hover:bg-teal-600 font-bold p-1 text-xs rounded-md"><a href="{{route('productinput')}}"> Add products</a></button>

@endsection