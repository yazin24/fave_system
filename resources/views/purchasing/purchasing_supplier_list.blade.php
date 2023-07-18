@extends('purchasing.purchasing_home')
@section('purchasing-body')

<div class="w-full">
    {{-- <form class="bg-indigo shadow-md rounded px-8 pt-6 pb-8 mb-4"> --}}

        <h2 class="font-bold text-xl mb-4 ml-1">Supplier List</h2>

            <div class="mt-4">

                <div class="bg-white-900 text-gray-900 mt-1">
                    <table class="bg-gray-300 shadow-lg w-full">
                        <thead class="">
                            <tr class="bg-gray-900 border-b-1 text-gray-300 w-96 h-12">
                                <th class="text-center w-1/4">SUPPLIER NAME</th>
                                <th class="text-center w-1/4">NUMBER</th>
                                <th class="text-center w-1/4">ADDRESS</th>
                                <th class="text-center w-1/4">ACTION</th>
                                
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                            <tr class="h-10">
                                <td class="border-b-2 text-sm text-center">{{$supplier -> supplier_name}}</td>
                                <td class="border-b-2 text-sm text-center">{{$supplier -> contact_number}}</td>
                                <td class="border-b-2 text-sm text-center">{{$supplier -> supplier_address}}</td>
                                <td class="border-b-2 text-sm text-center hover:underline text-red-600 hover:font-bold"><a href="{{route('showsupplierdetails', ['supplier' => $supplier -> id])}}">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
</div>

@endsection