@extends('admin.admin_home')

@section('admin-body')


        <div class="w-full">
            {{-- <form class="bg-indigo shadow-md rounded px-8 pt-6 pb-8 mb-4"> --}}
        
                <h2 class="font-bold md:text-xl mb-4 ml-1">Outgoing Stocks Monitoring</h2>

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
                           @foreach($pullOutItems as $pullOutItem)
                                <tr class="md:h-12">
                                    <td class="border-b-2 text-xs text-center ">{{$pullOutItem -> pull_out_number}}</td>
                                    <td class="border-b-2 text-xs text-center ">{{$pullOutItem -> requested_by}}</td>
                                    <td class="border-b-2 text-xs text-center ">{{$pullOutItem -> prepared_by}}</td>
                                    <td class="border-b-2 text-xs text-center ">{{$pullOutItem -> approved_by}}</td>
                                    <td class="border-b-2 text-xs text-center ">
                                       <a href="{{route('adminpulloutitems', ['pullOutItem' => $pullOutItem])}}" class="text-red-600 hover:underline hover:font-bold">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 font-bold">
                    {{-- {{$allPurchaseOrders->links()}} --}}
                </div>
            </div>
        
                
        </div>
@endsection