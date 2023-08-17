@extends('salesagent.agent_dashboard')

@section('sales_agent-functions')

<h2>Customer List</h2>

<div class="bg-white-900 text-gray-900 mt-1">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead class="">
            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 md:h-12">
                <th class="text-xs md:font-bold text-center">STORE NAME</th>
                <th class="text-xs text-center">FULL NAME</th>
                <th class="text-xs text-center">CP NUMBER</th>
                <th class="text-xs text-center">STOCKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allCustomers as $customer)
            <tr class="h-10">
                <td class="border-b-2 text-xs text-center">{{$customer -> store_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$customer -> full_name}}</td>
                <td class="border-b-2 text-xs text-center">{{$customer -> contact_number}}</td>
                <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('viewcustomersstocks', ['agent' => $agent, 'customer' => $customer])}}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection