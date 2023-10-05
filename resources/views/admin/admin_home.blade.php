@extends('layouts.app')

@section('content')

<div class="flex flex-row w-auto min-h-screen overflow-y-auto">
    <div class="hidden md:block flex bg-gray-900 h-screen text-gray-300 shadow-lg">
      <nav class=''>
        <h2 class='h-8 w-52 p-8 font-bold text-xl mb-4'>
            <i class="fa-solid fa-network-wired fa-xl"></i>
            Admin</h2>
        <ul>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-coins text-xl"></i>
              <div class="text-sm">Sales Monitoring</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminecommercedashboard')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-coins text-xl"></i>
              <div class="text-sm">Ecommerce Monitoring</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 '><a href='{{ route('adminpurchasingmonitoring')}}'>
            <div class='flex flex-row items-center gap-1'>
              <div><i class="fa-solid fa-rectangle-list text-xl"></i></div>
              <div class="text-sm">Purchasing Monitoring</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminpurchaseapproval')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-clipboard-question text-xl"></i>
              <div class="text-sm">Purchase Approval</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-address-book 2xl"></i>
              <div class="text-sm">Supplier List</div>
            </div>
            </a>
          </li>
          {{-- <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminunpurchase')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-link-slash text-xl"></i>
              <div class="text-sm">Unpurchase Order</div>
            </div>
            </a>
          </li> --}}
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminallproducts')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-cubes-stacked text-xl"></i>
              <div class="text-sm">Products</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminstockmonitoring')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-layer-group text-xl"></i>
              <div class="text-sm">Raw Materials</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminoutgoingstocks')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-outdent text-xl"></i>
              <div class="text-sm">Outgoing Stocks</div>
            </div>
            </a>
          </li>

        </ul>
      </nav>
    </div>
    
    <div class="ml-2 md:ml-6 mt-6 mr-2 md:mr-6 w-full">
      <div class="font-bold text-red-500 font-2xl">
        @if (session('success'))
            {{ session('success')}}
        @endif
    </div>
      @yield('admin-body')

    </div>
  </div>

@endsection