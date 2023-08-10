@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-md md:text-xl">Pull Out Items Details</h2>

<div class="mt-4">
   
    <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="font-bold">
                <div class="flex flex-row justify-between mb-2">
                <div class="mb-1">
                    <h2 class="text-sm md:text-md">PullOut Number: {{$pullOutItem -> pull_out_number}}</h2>
                </div>
                <div class="mb-1">
                    <h2 class="text-sm md:text-md">PullOut Date: {{$pullOutItem -> created_at -> format('d-m-y')}}</h2>
                </div>
                </div>
                <div class="mb-1">
                    <h2 class="text-sm md:text-md">Requested By: {{$pullOutItem -> requested_by}}</h2>
                </div>
                <div class="mb-1">
                    <h2 class="text-sm md:text-md">Prepared By: {{$pullOutItem -> prepared_by}}</h2>
                </div>
                <div class="mb-1">
                    <h2 class="text-sm md:text-md">Approved By: {{$pullOutItem -> approved_by}}</h2>
                </div>
            </div>

            <div class="bg-white-900 text-gray-900 mt-2"> 
                <table class="w-full shadow-md bg-gray-400">
                    <thead>
                        <tr class="bg-gray-900 text-gray-200 md:h-10">
                            <th class="w-1/4 font-bold text-sm md:text-md">Item Name</th>
                            <th class="w-1/4 font-bold text-sm md:text-md">Quantity</th>
                            <th class="w-1/4 font-bold text-sm md:text-md">Item Unit</th>
                            
                            
                        </tr>
                    </thead>    

                    <tbody class="bg-gray-300">
                        @foreach($pullOutItem -> pullOutItems as $index => $item )
                        <tr class="md:h-10">   
                            <td class="text-sm md:text-md text-center border-b-2 font-bold">{{$item -> allItems -> item_name}}</td>
                            <td class="text-sm md:text-md text-center border-b-2 font-bold">{{$item -> quantity}}</td>
                            <td class="text-sm md:text-md text-center border-b-2 font-bold">{{$item -> allItems -> item_unit}}</td>
                            
                        </tr>
                        @endforeach    
                    </tbody>
                </table>
           </div>
             
         </div>
        
    </div>
    
</div>

@endsection