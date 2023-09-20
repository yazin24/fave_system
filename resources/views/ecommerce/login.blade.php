@extends('ecommerce.navbar')

@section('content')

 
<div class="font-bold text-red-500 font-2xl">
    @if (session('success'))
        {{ session('success')}}
    @endif
</div>
<div class="container flex justify-center items-center h-screen">
    <div class="form-container p-4 bg-gradient-to-l from-violet-900 via-violet-400 to-blue-100 shadow backdrop-blur-sm drop-shadow-lg shadow-md h-3/4">
        <div class="flex justify-center">
        <img src="../images/newlogo.png" alt="" class="w-20 h-18 mt-20">
        </div>
        <form action="login-form" class="w-full block mb-10 p-8 border border-solid border-gray-800 rounded-md flex flex-col space-y-2"> 
            <input type="text" id="email" placeholder="Email" class="rounded-md p-2 w-72">
            <input type="text" id="password" placeholder="Password" class="rounded-md p-2 w-72">
            <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">Login</button>
            <div class="flex flex-col md:flex-row gap-2">
            <p class="">Don't have an account?</p> 
            <p class="underline cursor-pointer"><a href="register">Sign Up</a></p>
            </div>
        </form>  
    </div>

     <div class="flex md:justify-center items-center h-screen">
        <div class="container p-4 bg-gray-300 h-3/4 w-96">
            
        </div>
    </div>
</div>

@endsection