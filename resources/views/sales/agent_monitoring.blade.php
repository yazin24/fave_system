@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Agent Monitoring</h2>

<div class="flex justify-end">
    <button class="bg-teal-500 hover:bg-teal-600 text-gray-300 font-bold rounded-md p-1 text-xs shadow-md"><a href="{{route('newagent')}}">Add Agent</a></button>
</div>

<div class="bg-white-900 text-gray-900 mt-2">

    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-8 md:h-10">
                <th class="text-xs text-center w-1/8">AREA</th>
                <th class="text-xs text-center w-1/8">AGENT NAME</th>
                <th class="text-xs text-center w-1/8">CONTACT NUMBER</th>
                <th class="text-xs text-center hidden md:table-cell w-1/8">ADDRESS</th>
                <th class="text-xs text-center w-1/8">MESSENGER</th>
                <th class="text-xs text-center hidden md:table-cell w-1/8">EMAIL</th>
                <th class="text-xs text-center hidden md:table-cell w-1/8">DATE JOINED</th>
                <th class="text-xs text-center w-1/8">CUSTOMER</th>
            </tr>
        </thead>
        <tbody>
           @foreach($allAgents as $agent)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$agent -> areas -> area_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$agent -> agent_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$agent -> agent_number}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$agent -> agent_address}}</td>
                <td class="border-b-2 text-xs text-center">{{$agent -> fb_messenger}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$agent -> email_address}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$agent -> created_at -> format('Y-m-d h:s:i A')}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('agentdetails', ['agent' => $agent -> id])}}">View</a></td>
            </tr>
           @endforeach  
        </tbody>
    </table>
</div>


@endsection