@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Pull Out Monitoring</h2>

<div class="">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="md:h-8 bg-gray-900 border-b-2 text-gray-300">
                <th class="text-xs md:text-sm text-center">PULLOUT #</th>
                <th class="text-xs md:text-sm text-center">REQUESTED</th>
                <th class="text-xs md:text-sm text-center">PREPARED</th>
                <th class="text-xs md:text-sm text-center">APPROVED</th>
                <th class="text-xs md:text-sm text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
           @foreach($pullOuts as $pullOut)
                <tr class="md:h-12">
                    <td class="border-b-2 text-xs text-center ">{{$pullOut -> pull_out_number}}</td>
                    <td class="border-b-2 text-xs text-center ">{{$pullOut -> requested_by}}</td>
                    <td class="border-b-2 text-xs text-center ">{{$pullOut -> prepared_by}}</td>
                    <td class="border-b-2 text-xs text-center ">{{$pullOut -> approved_by}}</td>
                    <td class="border-b-2 text-xs text-center ">
                       <a href="{{route('pulloutdetails', ['pullOut' => $pullOut])}}" class="text-red-600 hover:underline hover:font-bold">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$pullOuts" />
</div>


@endsection