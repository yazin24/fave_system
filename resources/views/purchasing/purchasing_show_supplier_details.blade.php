@extends('purchasing.purchasing_home')
@section('purchasing-body')

<div class="w-full">

        <h2 class="font-bold text-xl mb-4 ml-1">Supplier's Details</h2>
       

        <div class="mt-4">
        
            <div class="bg-gray-900 rounded-md px-2 py-2 max-w-screen-sm mt-4">
                <div class="bg-gray-200 px-4 py-4"> 

                    <div class="md:flex flex-row justify-between">

                        <div>
                            <h2 class="font-bold">Supplier Name: {{$supplier -> supplier_name}}</h2>
                        </div>

                        <div class="flex items-center">
                            @if($supplier -> supplier_email)
                                <h2 class=""> Email: {{$supplier -> supplier_email}}</h2>
                            @else 
                                <h2>No Email</h2>
                            @endif
                        </div>

                    </div>
                    <div class="mt-1">
                        @if($supplier -> supplier_address)
                            <h2>Address: {{$supplier -> supplier_address}}</h2>
                        @else
                            <h2>No Address</h2>
                        @endif
                    </div>
                    <div class="mt-1">
                        @if($supplier -> contact_person)
                            <h2>Contact Person: {{$supplier -> contact_person}}</h2>
                        @else
                            <h2>No Contact Person</h2>
                        @endif
                    </div>

                        <div class="mt-1">
                            @if($supplier -> contact_number)
                                <h2>CP Number: {{$supplier -> contact_number}}</h2>
                            @else
                                <h2>No Number</h2>
                            @endif
                        </div>
                        <div class="mt-1">
                            @if($supplier -> tel_number)
                                <h2>Tel Number: {{$supplier -> tel_number}}</h2>
                            @else
                                <h2>No Tel Number</h2>
                            @endif
                        </div>
                        <div class="mt-1">
                            @if($supplier -> viber_account)
                                <h2>Viber: {{$supplier -> viber_account}}</h2>
                            @else
                                <h2>No Viber</h2>
                            @endif
                        </div>
                        <br>
                        <table class="w-full border border-gray-500 rounded-sm">
                            <thead>
                            <tr class="bg-green-700 text-gray-200">
                            <th class="w-1/3">Item Name</th>
                            <th class="w-1/3">Stocks</th>
                            <th class="w-1/3">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier -> supplierItems as $index => $item)
                                <tr class="">
                                    <td class="w-1/3 text-center">{{$item -> item_name}}</td>
                                   <td class="w-1/3 text-center">{{$item -> purchaseOrderItems}}</td>
                                   <td class="w-1/3 text-center">{{$item -> purchaseOrderItems}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                </div>
            </div>
        
        </div>

@endsection