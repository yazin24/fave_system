@extends('layouts.app')

@section('content')

<div class="flex">
    <div class="flex bg-gray-900 h-screen w-52 text-gray-300 shadow-lg">
      <nav class=''>
        <h2 class='h-8 w-52 p-8 font-bold text-xl'>
            <i class="fa-solid fa-list-check fa-xl"></i>
            Inventory</h2>
        <ul>
          <li class='h-8 w-52 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('stockmonitoring')}}'>
            <div class='flex items-center'>
              <div>Stock Monitoring</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('additem')}}'>
            <div class='flex items-center'>
              <div>Add Item</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('stocks')}}'>
            <div class='flex items-center'>
              <div>Stocks</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('supplier')}}'>
            <div class='flex items-center'>
              <div>Supplier</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-52 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('inventoryhistory')}}'>
            <div class='flex items-center'>
              <div>History</div>
            </div>
            </a>
          </li>

        </ul>
      </nav>
    </div>
    <div class="ml-10 mt-6">
      @yield('stock_monitoring')
      @yield('add_item')
      @yield('stocks')
      @yield('supplier')
      @yield('inventory_history')
    </div>
  </div>

@endsection