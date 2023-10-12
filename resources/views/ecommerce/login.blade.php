@extends('ecommerce.navbar')

@section('content')
 
<div class="font-bold text-red-500 font-2xl">
    @if (session('success'))
        {{ session('success')}}
    @endif
</div>

<div class="mt-32 mb-32 flex justify-center font-bold">

    <div class="flex flex-col justify-center bg-violet-700 p-10 shadow-md rounded-sm">
        <div class="flex justify-center mb-8">
            <img src="../images/newlogo.png" alt="" class="w-20 h-18">
        </div>
        <form method="POST" action="{{route('logincustomer')}}"  class="flex flex-col justify-center"> 
            @csrf
        <input type="email" name="email" placeholder="Email" class="rounded-sm p-2 w-72 mb-2">

        <input type="password" name="password" placeholder="Password" class="rounded-sm p-2 w-72">

        <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">LOGIN</button>

        <p class="mt-8 text-gray-100">Don't have an account?</p> 

        <p class="underline cursor-pointer text-gray-100 hover:text-amber-300"><a href="{{route('registerpage')}}">Sign Up</a></p>
        </form> 
    </div>

</div>

@endsection



{{-- <div class="flex flex-col justify-center items-center">

    <div>
        <img src="../images/newlogo.png" alt="" class="w-20 h-18 mt-20">
    </div>
    
    <div class="items-center">

        <form method="POST" action="{{route('logincustomer')}}"> 
            @csrf
            <input type="email" name="email" placeholder="Email" class="rounded-md p-2 w-72">
            <input type="password" name="password" placeholder="Password" class="rounded-md p-2 w-72">
            <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">Login</button>
            <div class="flex flex-col md:flex-row gap-2">
            <p class="">Don't have an account?</p> 
            <p class="underline cursor-pointer"><a href="register">Sign Up</a></p>
            </div>
        </form>  

    </div>

</div> --}}