@extends('ecommerce.navbar')

@section('content')

<div class="container flex justify-center items-center h-screen">
    <div class="form-container p-4 bg-gradient-to-l from-violet-900 via-violet-400 to-blue-100 shadow backdrop-blur-sm drop-shadow-lg shadow-md h-3/4">
        <div class="flex justify-center">
        <img src="../images/newlogo.png" alt="" class="w-20 h-18 mt-12">
        </div>
        <form method="POST" action="{{route('registercustomer')}}" class="w-full block mb-10 p-8 border border-solid border-gray-800 rounded-md flex flex-col space-y-2"> 
            @csrf
            <input type="text" id="full_name" id="full_name" placeholder="Fullname" class="rounded-md p-2 w-72">
            <input type="email" id="email" id="email" placeholder="Email" class="rounded-md p-2 w-72">
            <input type="text" id="phone" id="phone" placeholder="Phone Number" class="rounded-md p-2 w-72">
            <input type="password" id="password" id="password" placeholder="Password" class="rounded-md p-2 w-72">
            <input type="password" id="confirm_password" id="confirm_password" placeholder="Confirm Password" class="rounded-md p-2 w-72">
            <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">Sign up</button>
            <div class="flex flex-col md:flex-row gap-2">
            <p class="">Don't have an account?</p> 
            <p class="underline cursor-pointer"><a href="{{route('loginpage')}}">Log in</a></p>
            </div>   
        </form>    
    </div>    

     <div class="flex md:justify-center items-center h-screen">
        <div class="container p-4 bg-gray-300 h-3/4 w-96">
            
        </div>
    </div>
</div>

@endsection