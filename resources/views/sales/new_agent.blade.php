@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">New Agent</h2>

<div class="w-full md:w-1/2">
<div class="font-bold bg-gray-900 rounded-md p-2">
    <form method="POST" action="{{route('addagent')}}">
        @csrf
        <div class="w-full mb-1">
            <input type="text" placeholder="Full Name" class="h-10 w-full" name="full_name">
        </div>
        <div class="w-full mb-1">
            <input type="text" placeholder="Contact Number" class="h-10 w-full" name="contact_number">
        </div>
        <div class="w-full mb-1">
            <input type="text" placeholder="Address" class="h-10 w-full" name="address">
        </div>
        <div class="w-full mb-1">
            <input type="text" placeholder="Fb Messenger" class="h-10 w-full" name="fb_messenger">
        </div>
        <div class="w-full mb-1">
            <input type="text" placeholder="Email Address" class="h-10 w-full" name="email_address">
        </div>
        <div class="w-full relative mb-1 text-gray-500 text-xs">
           <select class="w-full h-10" id="designated_area" name="designated_area">
            <option disabled selected value="">Choose Area of Responsibility</option>
            @foreach ($allAreas as $area)
            <option value="{{$area -> id}}">{{$area -> area_name}}</option>
            @endforeach
           </select>
        </div>

        <div>
            <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold font-bold p-1 text-xs text-gray-300 rounded-md">Submit</button>
        </div>
    </form>
</div>
</div>

@endsection