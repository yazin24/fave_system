@extends('ecommerce.navbar')

@section('content')

<div class="mt-32 flex justify-center font-bold">

    <div class="flex flex-col justify-center bg-violet-700 p-10 shadow-md rounded-sm">
        <div class="flex justify-center mb-8">
        <img src="../images/newlogo.png" alt="" class="w-20">
        </div>
        @if($errors -> any())
        <div class="text-red-600 font-bold text-xs">
            <ul>
                @foreach($errors -> all() as $error)
                <li>*{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{route('registercustomer')}}" class="flex flex-col justify-center"> 
            @csrf
            <input type="text"  name="full_name" placeholder="Fullname" class="rounded-sm p-2 w-72 mb-2">
            <input type="email" name="email" placeholder="Email" class="rounded-sm p-2 w-72 mb-2">
            <input type="text"  name="phone" placeholder="Phone Number" class="rounded-sm p-2 w-72 mb-2">
            <input type="password" name="password" placeholder="Password" class="rounded-sm p-2 w-72 mb-2">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="rounded-sm p-2 w-72">
            <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-sm text-white cursor mt-2 hover:bg-amber-500">SIGN UP</button>
            <div class="flex flex-col mt-8 text-gray-100">
            <p class="">Already Sign up?</p> 
            <p class="underline cursor-pointer hover:text-amber-400"><a href="{{route('loginpage')}}">Log in</a></p>
            </div>   
        </form>    
    </div>    
</div>

@endsection

{{-- <div class="mt-32 flex justify-center font-bold">

    <div class="flex flex-col justify-center bg-violet-700 p-10 shadow-md rounded-sm">
        <div class="flex justify-center mb-8">
            <img src="../images/newlogo.png" alt="" class="w-20 h-18">
        </div>
        <form method="POST" action="{{route('logincustomer')}}"  class="flex flex-col justify-center"> 
            @csrf
        <input type="email" name="email" placeholder="Email" class="rounded-sm p-2 w-72 mb-2">

        <input type="password" name="password" placeholder="Password" class="rounded-sm p-2 w-72">

        <button type="submit" class="w-72 p-2 flex justify-center bg-stone-600 rounded-md text-white cursor mt-2 hover:bg-amber-500">Login</button>

        <p class="mt-8 text-gray-100">Don't have an account?</p> 

        <p class="underline cursor-pointer text-gray-100 hover:text-amber-300"><a href="{{route('registerpage')}}">Sign Up</a></p>
        </form> 
    </div>

</div> --}}