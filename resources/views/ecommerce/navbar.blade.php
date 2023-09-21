<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Fave Ecommerce Inc</title>
        <link rel="icon" href="{{ asset('images/newfavelogo.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        {{-- <link href="https://cdn.tailwindcss.com/2.2.19/tailwind.min.css" rel="stylesheet"> --}}

       
    </head>
    <body class="font-sans antialiased">
       
        <nav class='p-2 bg-violet-700 md:flex md:items-center md:justify-between'>
            <div>
                <span class='text-2xl font-[Poppins]cursor-pointer'></span>
                <img class='h-14 inline ml-10' src="../images/newlogo.png" alt=""/>   
            </div>
  
              <ul class='md:flex md:items-center md:z-auto md:static absolute w-full left-0 md:w-auto md:py-0 py-4 md:pl-0 pl-7 md:opacity-100'>
  
                <li class='mx-4 my-6 md:my-0'>
                    <a href="{{route('homepage')}}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Home</a>
                 </li>
  
                 <li class='mx-4 my-6 md:my-0'>  
                    <a href="{{route('productpage')}}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Products</a>
                 </li> 
  
                 <li class='mx-4 my-6 md:my-0'>
                    <a href="{{route('servicepage')}}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Services</a>
                 </li>
                 
                 <li class='mx-4 my-6 md:my-0'>
                    <a href="{{route('aboutuspage')}}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>About Us</a>
                 </li>
                 @guest('customers')
                 <li class='mx-4 my-6 md:my-0'>
                     <a href="{{ route('loginpage') }}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Login</a>
                 </li>
                 @else
                 <li class=''>
                  <a href="{{ route('loginpage') }}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Cart</a>
              </li>
                 <li class='mx-4 my-6 md:my-0'>
                 
                     <div class="hidden sm:flex sm:items-center sm:ml-6">
                         <x-dropdown align="right" width="48">
                             <x-slot name="trigger">
                                 <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                     {{-- <div class="capitalize text-xs">{{ Auth::customers()->name }}</div> --}}
             
                                     <div class="ml-1">
                                         <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                             <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                         </svg>
                                     </div>
                                 </button>
                             </x-slot>
             
                             <x-slot name="content">
                                 <x-dropdown-link :href="route('profile.edit')">
                                     {{ __('Profile') }}
                                 </x-dropdown-link>

                                 <x-dropdown-link :href="route('addtocart')">
                                  {{ __('Shopping Cart') }}
                              </x-dropdown-link>
             
                                 <!-- Authentication -->
                                 <form method="POST" action="{{ route('logoutcustomer') }}">
                                     @csrf
             
                                     <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                         {{ __('Log Out') }}
                                     </x-dropdown-link>
                                 </form>
                             </x-slot>
                         </x-dropdown>
                     </div>
                    
                 </li>
                 @endguest
                
              </ul>
          </nav>

            <!-- Page Content -->
            <main class="">
              {{-- <div class="font-bold text-red-500 font-2xl">
                @if (session('success'))
                    {{ session('success')}}
                @endif
            </div> --}}
                @yield('content')
            </main>
        </div>
    </body>
    <footer class="">  
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="rgb(153, 51, 255)" fill-opacity="1" d="M0,160L80,154.7C160,149,320,139,480,144C640,149,800,171,960,154.7C1120,139,1280,85,1360,58.7L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg>
        <div class="px-8 md:pb-6 bord ">
          <div class="flex md:space-x-14 md:flex-row justify-between mx-8 grid grid-cols-1 md:grid-cols-3">
            <div class="mb-4 md:mb-0">
              <a href="/">
                <img
                  src="../images/newlogo.png"
                  alt=""
                  class="h-24 w-22 cursor-pointer"
                />
              </a>
            </div>

            <div class="flex flex-col">
              <p class="font-semibold text-white">Fave Ecommerce Inc.</p>
              <p class="font-semibold text-white">
                8 Calle Industria Bagumbayan, Quezon City
              </p>
              <p class="font-semibold text-white">625-916-359-000</p>
              <p class="font-semibold text-white">0998-887-3878</p>
              <p class="font-semibold text-white">faveecommerce@gmail.com</p>
            </div>

            <div class="mt-8 md:mt-12 flex flex-row sm:flex-row py-4 mx-auto items-center justify-end space-x-1">
              <div class="">
                <a href="https://www.facebook.com/people/Fave-Ecommerce-Inc/100094725815233/">
                  <i class="fa-brands fa-facebook h-10 w-10 text-white cursor-pointer"></i>
                </a>
              </div>

              <div class="">
                <a href="https://www.tiktok.com/@fave.ecommerce?_t=8fGbcYaYbIX&_r=1">
                  <i class="fa-brands fa-tiktok h-10 w-10 text-white cursor-pointer"></i>
                </a>
              </div>

              <div class="">
                <a href="https://youtube.com/@Faveecommerce?si=BkbtUjGwI7v4fLfP">
                  <i class="fa-brands fa-youtube h-10 w-10 text-white cursor-pointer"></i>
                </a>
              </div>

              <div class="">
                <i class="fa-solid fa-envelope h-10 w-10 text-white cursor-pointer"></i>
              </div>
            </div>
          </div>
      </div>
        
    </footer>
</html>