@extends('admin.admin_home')

@section('admin-body')

<div class="w-full mx-auto">
    
        <h2 class="font-bold text-xl mb-4">Supplier Details</h2>

        <div class="mt-4">
   
            <div class="bg-gray-900 rounded-md px-4 py-4 max-w-screen-sm mt-4">
                <div class="bg-gray-200 px-4 py-4"> 
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Supplier Name: {{$supplier -> supplier_name}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Address: {{$supplier -> supplier_address}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Contact Number: {{$supplier -> contact_number}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Telephone Number: {{$supplier -> tel_number}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Contact Person: {{$supplier -> contact_person}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Email Address: {{$supplier -> supplier_email}}</h2>
                    </div>
                    <br>
                    <div class=" border-b-2 border-gray-300">
                        <h2 class="font-bold">Viber Account: {{$supplier -> viber_account}}</h2>
                    </div>
                    <br>
                 </div>
        
            </div>

</div>
@endsection