@extends('salesagent.sales_agent_home')

@section('sales_agent-body')

<h2 class="font-bold md:text-xl mt-2 mb-1"><span class="text-blue-500 font-bold">{{$agent -> agent_name}}</span> Dashboard!</h2>

<div>

<div class="flex flex-row gap-4 justify-end">
<div>
   
     <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href="{{route('requestpo', ['agent' => $agent -> id])}}">Request P.O</a></button>
</div>    
<div>
    <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href="{{route('newcustomer', ['agent' => $agent -> id])}}">Add Customer</a></button>
</div>    

</div>

<div>
    @yield('sales_agent-functions')
</div>

</div>



@endsection