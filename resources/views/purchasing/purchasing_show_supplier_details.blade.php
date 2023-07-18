@extends('purchasing.purchasing_home')
@section('purchasing-body')

<div class="w-full">

        <h2 class="font-bold text-xl mb-4 ml-1">Supplier's Details</h2>
       

        <div class="mt-4">
        
            <div class="bg-gray-900 rounded-md px-2 py-2 max-w-screen-sm mt-4">
                <div class="bg-gray-200 px-4 py-4"> 

                    <div class="flex flex-row justify-between">

                        <div>
                            <h2 class="font-bold text-xl">{{$supplier -> supplier_name}}</h2>
                        </div>

                        <div class="flex items-center">
                            @if($supplier -> supplier_address)
                                <h2 class="">{{$supplier -> supplier_address}}</h2>
                            @else 
                                <h2>No Address</h2>
                            @endif
                        </div>

                    </div>

                        <div class="mt-1">
                            @if($supplier -> contact_number)
                                <h2>{{$supplier -> contact_number}}</h2>
                            @else
                                <h2>No Number</h2>
                            @endif
                        </div>
                        <br>
                        <table class="w-full border border-gray-500 rounded-sm">
                            <thead>
                            <tr class="bg-green-700 text-gray-200">
                            <th>Item Name</th>
                            <th>Stocks</th>
                            <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier -> supplierItems as $index => $item)
                                <tr class="flex justify-center">
                                    <td>{{$item -> item_name}}</td>
                                   <td>{{$item -> purchaseOrderItems -> sum('quantity')}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                </div>
            </div>
        
        </div>

@endsection