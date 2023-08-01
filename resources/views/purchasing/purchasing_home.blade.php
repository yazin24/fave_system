@extends('layouts.app')

@section('content')
<div class="flex w-auto h-screen">

  <div class="flex bg-gray-900 text-gray-300 shadow-lg">

    <nav class='hidden md:block'>
      <h2 class='h-8 w-56 p-8 font-bold text-xl mb-4'>
        <i class="fa-solid fa-table fa-xl"></i>
        Purchasing</h2>
      <ul>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('purchasemonitoring')}}'>
          <div class='flex items-center'>
            <div>Purchase Monitoring</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('purchase')}}'>
          <div class='flex items-center'>
            <div>Purchase</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('allpurchases')}}'>
          <div class='flex items-center'>
            <div>All Purchases</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('addsupplier')}}'>
          <div class='flex items-center'>
            <div>Add Supplier</div>
          </div>
        </a>
        </li>
        <li class='h-8 w-56 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('purchasingsupplierlist')}}'>
          <div class='flex items-center'>
            <div>Supplier List</div>
          </div>
        </a>
        </li>
      </ul>
    </nav>
  </div>
  
  <div class="ml-6 mt-6 mr-6 w-full">
    <div class="font-bold text-red-500 font-2xl">
      @if (session('success'))
          {{ session('success') }}
      @endif
  </div>
    @yield('purchasing-body')
  </div>

</div>

<script>

  const buttonMenu = document.getElementById('sidebarMenu');
  const menuItems = document.getElementById('menuItems');

  toggleButton.addEventListener('click', () => {
    menuItems.classList.toggle('hidden');
  });

</script>
@endsection