<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Fave System</title>
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

        <style>
            .paginator {
                font-size: 1px !important;
            }
        </style>
       
    </head>
    <body class="font-sans antialiased">
       
        <nav class='p-5 bg-gradient-to-l from-violet-900 via-violet-400 to-blue-100 shadow md:flex md:items-center md:justify-between'>
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
                 <li class='mx-4 my-6 md:my-0'>
                    <a href="{{route('aboutuspage')}}" class='text-yellow-600 md:text-gray-200 font-bold hover:bg-yellow-500 md:p-6 md:pt-10 duration-200'>Login</a>
                 </li>
               
                
              </ul>
          </nav>

            <!-- Page Content -->
            <main class="">
                @yield('content')
            </main>
        </div>
    </body>
</html>