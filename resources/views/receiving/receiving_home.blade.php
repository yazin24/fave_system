@extends('layouts.app')

@section('content')
<div class="flex w-auto h-screen">

  <div class="flex bg-gray-900 text-gray-300 shadow-lg">
    <nav class='hidden md:block'>
      <h2 class='h-8 w-56 p-8 font-bold text-xl mb-4'>
        <i class="fa-solid fa-warehouse"></i>
        Receiving</h2>
      <ul>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('receivedpomonitoring')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-desktop text-xl"></i>
            <div class="text-xs">Receive Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('receivepo')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-file-medical text-xl"></i>
            <div class="text-xs">Receive P.O</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('pulloutmonitoring')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-outdent text-xl"></i>
            <div class="text-xs">Pull-Out Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('pullout')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-upload text-xl"></i>
            <div class="text-xs">Pull-Out</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('manufacturingstorage')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-box-open text-xl"></i>
            <div class="text-xs">Manufacturing Storage</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('allproducts')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-cubes-stacked text-xl"></i>
            <div class="text-xs">Products</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('rawmaterials')}}'>
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-cubes text-xl"></i>
            <div class="text-xs">Raw Materials</div>
          </div>
        </a>
        </li>
      </ul>
    </nav>
  </div>
  
  <div class="mx-2 md:ml-6 mt-6 md:mr-6 w-full">
    <div class="font-bold text-red-500 font-2xl">
  </div>
    @yield('receiving-body')
    
    <div class="font-bold text-red-500 font-2xl">
      @if (session('success'))
          {{ session('success') }}
      @endif
  </div>

  </div>

</div>
@endsection