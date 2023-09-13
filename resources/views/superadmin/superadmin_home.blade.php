@extends('layouts.app')

@section('content')

<div class="flex flex-row w-auto min-h-screen overflow-y-auto">
    <div class="hidden md:block flex bg-gray-900 h-screen text-gray-300 shadow-lg">
      <nav class=''>
        
        <h2 class='flex flex-row h-8 w-52 p-8 font-bold text-md mb-4'>
            <div>
                <svg width="40px" height="40px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M878.3 192.9H145.7c-16.5 0-30 13.5-30 30V706c0 16.5 13.5 30 30 30h732.6c16.5 0 30-13.5 30-30V222.9c0-16.5-13.5-30-30-30z" fill="#FFFFFF" /><path d="M145.7 736h732.6c16.5 0 30-13.5 30-30v-22.1H115.7V706c0 16.6 13.5 30 30 30z" fill="#E6E6E6" /><path d="M878.3 152.9H145.7c-38.6 0-70 31.4-70 70V706c0 38.6 31.4 70 70 70h732.6c38.6 0 70-31.4 70-70V222.9c0-38.6-31.4-70-70-70z m30 531V706c0 16.5-13.5 30-30 30H145.7c-16.5 0-30-13.5-30-30V222.9c0-16.5 13.5-30 30-30h732.6c16.5 0 30 13.5 30 30v461zM678 871.1H346c-11 0-20-9-20-20s9-20 20-20h332c11 0 20 9 20 20s-9 20-20 20z" fill="#005BFF" /><path d="M127.1 662.7c-2.7 0-5.4-1.1-7.3-3.2-3.7-4.1-3.5-10.4 0.6-14.1l236.5-219.6L463 541.9l258.9-290.7 183.7 196.3c3.8 4 3.6 10.4-0.4 14.1-4 3.8-10.3 3.6-14.1-0.4L722.3 280.8l-259 290.9L355.7 454 133.9 660c-2 1.8-4.4 2.7-6.8 2.7z" fill="#06F3FF" /><path d="M156.4 541.9a82.7 82.8 0 1 0 165.4 0 82.7 82.8 0 1 0-165.4 0Z" fill="#D7E7FF" /><path d="M179.8 541.9a59.3 59.3 0 1 0 118.6 0 59.3 59.3 0 1 0-118.6 0Z" fill="#B5CFF4" /><path d="M208.9 541.9a30.2 30.3 0 1 0 60.4 0 30.2 30.3 0 1 0-60.4 0Z" fill="#005BFF" /><path d="M580.9 329.9a82.7 82.8 0 1 0 165.4 0 82.7 82.8 0 1 0-165.4 0Z" fill="#D7E7FF" /><path d="M604.3 329.9a59.3 59.3 0 1 0 118.6 0 59.3 59.3 0 1 0-118.6 0Z" fill="#B5CFF4" /><path d="M633.4 329.9a30.2 30.3 0 1 0 60.4 0 30.2 30.3 0 1 0-60.4 0Z" fill="#005BFF" /><path d="M719.3 539.6a46.3 46.4 0 1 0 92.6 0 46.3 46.4 0 1 0-92.6 0Z" fill="#D7E7FF" /><path d="M732.4 539.6a33.2 33.2 0 1 0 66.4 0 33.2 33.2 0 1 0-66.4 0Z" fill="#B5CFF4" /><path d="M748.7 539.6a16.9 17 0 1 0 33.8 0 16.9 17 0 1 0-33.8 0Z" fill="#005BFF" /><path d="M436.8 720.1H275.2c-5 0-9-4-9-9s4-9 9-9h161.6c5 0 9 4 9 9 0 4.9-4.1 9-9 9zM220.6 720.1h-26.5c-5 0-9-4-9-9s4-9 9-9h26.5c5 0 9 4 9 9 0 4.9-4.1 9-9 9z" fill="#FFFFFF" /></svg>
            </div>
            <div class="text-md text-center mt-2 ml-0.5">
                Super Admin
            </div>
           
           </h2>
        <ul class="border-t-2 ml-4">
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-coins text-xl"></i>
              <div class="text-xs">Sales</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{ route('adminpurchasingmonitoring')}}'>
            <div class='flex flex-row items-center gap-1'>
              <div><i class="fa-solid fa-rectangle-list text-xl"></i></div>
              <div class="text-sm">Purchasing</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminpurchaseapproval')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-hands-holding-circle text-xl"></i>
              <div class="text-sm">Receiving</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-truck-field text-xl"></i>
              <div class="text-sm">Suppliers</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-cubes-stacked text-xl"></i>
              <div class="text-sm">Products</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-address-book 2xl"></i>
              <div class="text-sm">Raw Materials</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-cubes text-xl"></i>
              <div class="text-sm">Manufacturing Storage</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-hat-cowboy text-xl"></i>
              <div class="text-sm">Agents</div>
            </div>
            </a>
          </li>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8 border-t-2 border-b-2'><a href='{{route('adminsupplierlist')}}'>
            <div class='flex items-center gap-1'>
                <i class="fa-solid fa-people-group text-xl"></i>
              <div class="text-sm">Agent Customer</div>
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