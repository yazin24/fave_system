@extends('salesagent.agent_dashboard')

@section('sales_agent-functions')

<h2>New Customer</h2>

<div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-2">

    <form method="POST" action="{{route('addcustomer', ['agent' => $agent -> id])}}">
        @csrf
    <div class="bg-gray-200 px-4 py-4"> 

        <div class="flex flex-col md:flex-row md:justify-between">
            <div class="mb-1 font-bold">
                <h2 class="text-xs md:text-sm">Agent Name: {{$agent -> agent_name}}</h2>
            </div>
            <div class="mb-1 font-bold">
                <h2 class="text-xs md:text-sm">Designated Area: {{$agent -> areas -> area_name}}</h2>
            </div>
        </div>
        <hr class="border border-gray-400 my-2">
        <h2 class="text-xs font-bold mb-1">**Customer Details</h2>
        <div class="mb-1 font-bold">
            <input type="text" placeholder="Store Name" class="h-6 w-full" name="store_name">
        </div>
        <div class="mb-1 font-bold">
            <input type="text" placeholder="Full Name" class="h-6 w-full" name="full_name">
        </div>

        <div class="mb-1 font-bold">
            <input type="text" placeholder="Contact Number" class="h-6 w-full" name="contact_number">
        </div>

        <div class="mb-1 font-bold">
            <input type="text" placeholder="Address" class="h-6 w-full" name="address">
        </div>

     </div>

     <button type="submit" class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 text-xs">
       Submit
    </button>
    </form>
   
</div>


@endsection
