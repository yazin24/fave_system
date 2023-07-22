@extends('layouts.app')

@section('content')
<div class="flex w-auto h-screen">

  <div class="flex bg-gray-900 w-56 text-gray-300 shadow-lg">
    <nav class=''>
      <h2 class='h-8 w-56 p-8 font-bold text-xl mb-4'>
        <i class="fa-solid fa-table fa-xl"></i>
        Receiving</h2>
      <ul>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('purchasemonitoring')}}'>
          <div class='flex items-center'>
            <div>Receiving Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('purchase')}}'>
          <div class='flex items-center'>
            <div>Receive P.O</div>
          </div>
        </a>
        </li>
      </ul>
    </nav>
  </div>
  
  <div class="ml-6 mt-6 mr-6 w-full">
    <div class="font-bold text-red-500 font-2xl">
  </div>
    @yield('receiving-body')
  </div>

</div>
@endsection