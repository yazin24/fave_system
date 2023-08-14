@extends('salesagent.sales_agent_home')

@section('sales_agent-body')

<h2 class="font-bold md:text-xl mt-2">Customer Monitoring</h2>

<div class="flex justify-end">
    <button class="bg-teal-500 hover:bg-teal-600 font-bold shadow-md p-1 rounded-md text-gray-300 text-xs"><a href="{{route('newcustomer')}}">Add New</a></button>
</div>


@endsection