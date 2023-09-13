@extends('layouts.app')

@section('content')

<div class="flex flex-row w-auto min-h-screen overflow-y-auto">
    <div class="hidden md:block flex bg-gray-900 h-screen text-gray-300 shadow-lg">
      <nav class=''>
        <h2 class='h-8 w-52 p-8 font-bold text-lg mb-4'>
            <i class="fa-solid fa-network-wired text-xl"></i>
           Super Admin</h2>
        <ul>
          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
            <div class='flex items-center gap-1'>
              <i class="fa-solid fa-coins text-xl"></i>
              <div class="text-sm">Sales Monitoring</div>
            </div>
            </a>
          </li>
          <!-- Add a dropdown for Sales Monitoring -->
          <li class='relative group h-8 w-60 hover:bg-teal-600 hover:font-bold'>
            <div class='flex items-center gap-1 cursor-pointer'>
                
              <div class="text-sm">Sales Dropdown</div>
              <button class="transition-transform transform"><i class="fa-solid fa-caret-down text-xl"></i></button>
            </div>
            <ul class="absolute hidden mt-2 space-y-2 text-gray-800 group-hover:block max-h-0 overflow-hidden transition-max-h">
                <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
                    <div class='flex items-center gap-1'>
                      <i class="fa-solid fa-coins text-xl"></i>
                      <div class="text-sm">Sales Monitoring</div>
                    </div>
                    </a>
                  </li>
                  <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
                    <div class='flex items-center gap-1'>
                      <i class="fa-solid fa-coins text-xl"></i>
                      <div class="text-sm">Sales Monitoring</div>
                    </div>
                    </a>
                  </li>
                  <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{route('adminsalesmonitoring')}}'>
                    <div class='flex items-center gap-1'>
                      <i class="fa-solid fa-coins text-xl"></i>
                      <div class="text-sm">Sales Monitoring</div>
                    </div>
                    </a>
                  </li>
            </ul>
          </li>

          <li class='h-8 w-60 hover:bg-teal-600 hover:font-bold p-8'><a href='{{ route('adminpurchasingmonitoring')}}'>
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
          <!-- Continue with the rest of your list items -->
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

  <script>
    document.querySelectorAll('.relative').forEach((item) => {
      const button = item.querySelector('button');
      const dropdown = item.querySelector('ul');

      button.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
        // Adjust the position of content below the dropdown
        const contentBelowDropdown = item.nextElementSibling;
        if (!dropdown.classList.contains('hidden')) {
          contentBelowDropdown.style.marginTop = dropdown.offsetHeight + 'px';
        } else {
          contentBelowDropdown.style.marginTop = '0';
        }
      });
    });
  </script>

@endsection