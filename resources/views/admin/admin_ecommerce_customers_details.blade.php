@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl mt-2">Customer Details</h2>

<div class="">
   
    <div class="bg-gray-900 rounded-sm p-1 max-w-screen-sm">
        <div class="bg-gray-200 px-4 py-4"> 

            <div class="flex flex-row mb-2 text-xs"> 
                <div>
                    <h2 class="text-gray-800 font-bold">Name: <span class="text-blue-600 font-bold">{{$customer -> name}}</span></h2>
                </div>

                <div class="ml-auto">
                    <h2 class="text-gray-800 font-bold">Phone Number: <span class="text-red-700 font-bold capitalize">{{$customer -> phone_number}}</span></h2>
                </div>
             </div>
             <h2 class="text-gray-800 mb-2 font-bold text-xs">Email: <span class="text-blue-600 font-bold">{{$customer -> email}}</span></h2>
               
        
         </div>

    </div>
    
</div>
</div>


@endsection