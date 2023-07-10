@extends('layouts.app')

@section('content')
<div class="flex">
  <div>
    <div class="flex bg-gray-900 h-screen w-52 text-gray-300 shadow-lg">
      <nav class=''>
        <h2 class='h-8 w-52 p-8 font-bold text-xl'>
            <i class="fa-solid fa-table fa-xl"></i>
            Purchasing</h2>
        <ul>
          <li class='h-8 w-52 hover:bg-blue-500 p-8'><a href=''>
            <div class='flex items-center'>
              <div>Sales Monitoring</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-blue-500 p-8'><a href='{{route('make.purchase')}}'>
            <div class='flex items-center'>
              <div>Purchase</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-blue-500 p-8'><a href=''>
            <div class='flex items-center'>
              <div>Supplier List</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-blue-500 p-8'><a href=''>
            <div class='flex items-center'>
              <div>History</div>
            </div>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </div>
  <div>
    @yield('content')
  </div>
</div>

@endsection