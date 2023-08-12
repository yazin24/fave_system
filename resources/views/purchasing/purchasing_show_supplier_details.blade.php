@extends('purchasing.purchasing_home')
@section('purchasing-body')

<div class="w-full">

        <h2 class="font-bold md:text-xl mb-4 ml-1">Supplier's Details</h2>
       

        <div class="mt-4">
        
            <div class="bg-gray-900 rounded-md px-2 py-2 max-w-screen-sm mt-4">
                <div class="bg-gray-200 px-4 py-4"> 

                    <div class="md:flex flex-row justify-between">

                        <div>
                            <h2 class="font-bold text-md">Supplier Name: {{$supplier -> supplier_name}}</h2>
                        </div>

                        <div class="flex items-center">
                            @if($supplier -> supplier_email)
                                <h2 class="text-sm"> Email: {{$supplier -> supplier_email}}</h2>
                            @else 
                                <h2 class="text-sm">No Email</h2>
                            @endif
                        </div>
                    
                    </div>
                    <div class="mt-1">
                        @if($supplier -> supplier_address)
                            <h2 class="text-sm">Address: {{$supplier -> supplier_address}}</h2>
                        @else
                            <h2 class="text-sm">No Address</h2>
                        @endif
                    </div>
                    <div class="mt-1">
                        @if($supplier -> contact_person)
                            <h2 class="text-sm">Contact Person: {{$supplier -> contact_person}}</h2>
                        @else
                            <h2 class="text-sm">No Contact Person</h2>
                        @endif
                    </div>

                        <div class="mt-1">
                            @if($supplier -> contact_number)
                                <h2 class="text-sm">CP Number: {{$supplier -> contact_number}}</h2>
                            @else
                                <h2 class="text-sm">No Number</h2>
                            @endif
                        </div>
                        <div class="mt-1">
                            @if($supplier -> tel_number)
                                <h2 class="text-sm">Tel Number: {{$supplier -> tel_number}}</h2>
                            @else
                                <h2 class="text-sm">No Tel Number</h2>
                            @endif
                        </div>
                        <div class="mt-1">
                            @if($supplier -> viber_account)
                                <h2 class="text-sm">Viber: {{$supplier -> viber_account}}</h2>
                            @else
                                <h2 class="text-sm">No Viber</h2>
                            @endif
                        </div>
                        <br>
                        <table class="w-full rounded-sm bg-gray-300">
                            <thead>
                            <tr class="bg-gray-900 text-gray-200 text-sm">
                            <th class="w-1/3">Item Name</th>
                            <th class="w-1/3">Stocks</th>
                            <th class="w-1/3">Default Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier ->allItems as $item)
                                <tr class="h-8">
                                    <td class="text-xs md:text-sm text-center border-b-2 font-bold">{{$item -> item_name}}</td>
                                   <td class="text-xs md:text-sm text-center border-b-2 font-bold">{{$item -> quantity}}</td>
                                   <td class="text-xs md:text-sm text-center border-b-2 font-bold">{{$item -> default_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                </div>
            </div>
        
        </div>

@endsection