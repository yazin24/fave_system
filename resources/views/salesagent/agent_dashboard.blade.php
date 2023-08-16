@extends('salesagent.sales_agent_home')

@section('sales_agent-body')

<h2 class="font-bold md:text-xl mt-2 mb-1"><span class="text-blue-500 font-bold">{{$agent -> agent_name}}</span> Dashboard!</h2>

<div class="">

<div class="flex flex-row gap-4 justify-start">
    <div>
        <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href=""><i class="fa-solid fa-arrows-rotate text-2xl px-2 sm:px-4"></i></a></button>
   </div> 
    <div>
        <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href=""><i class="fa-solid fa-money-bill-1-wave text-2xl px-2 sm:px-4"></i></a></button>
   </div> 
<div>
     <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href="{{route('requestpo', ['agent' => $agent -> id])}}"><i class="fa-solid fa-bag-shopping text-2xl px-2 sm:px-4"></i></a></button>
</div> 
<div>
    <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href="{{route('newcustomer', ['agent' => $agent -> id])}}"><i class="fa-solid fa-store text-2xl px-2 sm:px-4"></i></a></button>
</div>       
<div>
    <button class="bg-teal-500 hover:bg-teal-600 p-1 text-xs font-bold rounded-sm shadow-md text-gray-200"><a href="{{route('newcustomer', ['agent' => $agent -> id])}}"><i class="fa-solid fa-user-plus text-2xl px-2 sm:px-4"></i></a></button>
</div>    

</div>

<div>
    @yield('sales_agent-functions')
</div>

</div>



@endsection