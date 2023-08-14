@extends('layouts.app')

@section('content')
<div class="flex w-auto h-screen">

  <div class="flex bg-gray-900 text-gray-300 shadow-lg">
    <nav class='hidden md:block'>
      <h2 class='h-8 w-56 p-8 font-bold text-xl'>
        <i class="fa-solid fa-wallet fa-xl"></i>
        Sales Staff</h2>
      <ul>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('salesmonitoring')}}">
          <div class='flex items-center gap-1'>
            <i class="fa-solid fa-coins text-xl"></i>
            <div>Sales Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('salespurchaseorders')}}">
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-cart-shopping text-xl"></i>
              <div>Purchase Order</div>
            </div>
          </a>
          </li>
          <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8 mt-4'><a href="{{route('agentmonitoring')}}">
            <div class='flex items-center gap-1'>
                <i class="fa-brands fa-redhat text-xl"></i>
              <div>Agent Monitoring</div>
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
    @yield('sales-body')
  </div>

</div>
@endsection