@extends('salesagent.sales_agent_home')

@section('sales_agent-body')

<h2 class="font-bold md:text-xl mt-2">Enter Password!</h2>
@error('password')
        <p class="text-red-500">{{ $message }}</p>
    @enderror

<div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">

    <form method="POST" action="{{route('verifypassword', ['agent' => $agent -> id])}}">
        @csrf
    <div class="bg-gray-200 px-4 py-4"> 

        <div class="mb-1 font-bold">
            <h2>Agent Name: {{$agent -> agent_name}}</h2>
        </div>
        <div class="mb-1 font-bold">
            <h2>Designated Area: {{$agent -> areas -> area_name}}</h2>
        </div>
        <div class="mb-1 font-bold">
            <h2>Contact Number: {{$agent -> agent_number}}</h2>
        </div>
        <div class="mb-1 font-bold">
            <label>Enter Password:</label>
            <input type="password" placeholder="" class="h-6" name="password">
        </div>

     </div>

     <button type="submit" class="bg-teal-500 p-1 mt-2 rounded-md text-gray-200 text-xs">
       Submit
    </button>

    </form>
</div>


@endsection