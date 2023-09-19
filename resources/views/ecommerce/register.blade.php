@extends('ecommerce.navbar')

@section('content')

<div class="container flex justify-center items-center h-screen">
    <div class="form-container p-20 rounded-md bg-gradient-to-l from-violet-900 via-violet-400 to-blue-100 shadow backdrop-blur-sm drop-shadow-lg shadow-md">
        <div class="flex justify-center">
        <img src="../images/newlogo.png" alt="" class="w-20 h-18">
        </div>
        <form action="login-form" class="w-full block mb-10 p-8 border border-solid border-gray-900 rounded-md flex flex-col space-y-2"> 
            <input type="text" id="fullname" placeholder="Fullname" class="rounded-md p-2 w-72">
            <input type="text" id="email" placeholder="Email" class="rounded-md p-2 w-72">
            <input type="text" id="phone" placeholder="Phone Number" class="rounded-md p-2 w-72">
            <input type="text" id="password" placeholder="Password" class="rounded-md p-2 w-72">
            <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">Sign up</button>
            <div class="flex flex-col md:flex-row gap-2">
            <p class="">Don't have an account?</p> 
            <p class="underline cursor-pointer"><a href="login">Log in</a></p>
            </div>
            
        </form>
        
    </div>    
</div>

@endsection