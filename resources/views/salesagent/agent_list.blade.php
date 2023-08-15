@extends('salesagent.sales_agent_home')

@section('sales_agent-body')

<h2 class="font-bold md:text-xl mt-2">Agent List</h2>

<div class="bg-white-900 text-gray-900 mt-2">

    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-8 md:h-10">
                <th class="text-xs text-center w-1/8">AREA</th>
                <th class="text-xs text-center w-1/8">AGENT NAME</th>
                <th class="text-xs text-center w-1/8 hidden md:table-cell"">CONTACT NUMBER</th>
                <th class="text-xs text-center w-1/8">DASHBOARD</th>
            </tr>
        </thead>
        <tbody>
           @foreach($allAgents as $agent)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$agent -> areas -> area_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$agent -> agent_name}}</td>
                <td class="border-b-2 text-xs text-center hidden md:table-cell"">{{$agent -> agent_number}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('enterpassword', ['agent' => $agent -> id])}}">View</button></td>
            </tr>
           @endforeach  
        </tbody>
    </table>
</div>

@endsection