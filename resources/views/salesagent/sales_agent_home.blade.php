@extends('layouts.app')

@section('content')
<div class="flex w-auto h-screen">

  <div class="flex bg-gray-900 text-gray-300 shadow-lg">
    <nav class='hidden md:block'>
      <h2 class='h-8 w-56 p-8 font-bold text-xl'>
        <i class="fa-brands fa-redhat fa-xl"></i>
        Sales Agent</h2>
      <ul>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('salesagentmonitoring')}}">
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-coins text-xl"></i>
            <div>Sales Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('requestpo')}}">
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-cart-shopping text-xl"></i>
              <div>Request P.O</div>
            </div>
          </a>
          </li>
          <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('customermonitoring')}}">
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-person text-xl"></i>
              <div>CS Monitoring</div>
            </div>
          </a>
          </li>
      </ul>
    </nav>
  </div>
  
  <div class="mx-2 md: mt-6 md:mr-6 w-full">
    <div class="font-bold text-red-500 font-2xl">
      @if (session('success'))
          {{ session('success') }}
      @endif
  </div>
    @yield('sales_agent-body')
  </div>

</div>
@endsection