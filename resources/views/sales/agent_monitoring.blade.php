@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Agent Monitoring</h2>

<div class="flex justify-end">
    <button class="bg-teal-500 hover:bg-teal-600 text-gray-300 font-bold rounded-md p-1 text-xs shadow-md"><a href="{{route('newagent')}}">Add Agent</a></button>
</div>


@endsection