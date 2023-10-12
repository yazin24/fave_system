<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Fave Ecommerce Inc</title>
  <link rel="icon" href="{{ asset('images/newfavelogo.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
  <script src="https://www.paypal.com/sdk/js?client-id=AV7Up2sl4_s6_qV8Z_n3RwvDwMLT4Qit60rhAeT_cF3D_TTyD5PL8S9oU13MUixNwFoKPx3rqDnTj3_s&currency=PHP"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="animate.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="path/to/tailwind.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-element-bundle.min.js"></script>
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  
  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
      .modal {
      transition: opacity 0.25s ease;
    }
    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
      .wrapper {
        
          height: 48rem;
          width: 100%;
          background:linear-gradient(to left bottom, rgb(219, 234, 254), rgb(147, 197, 253), rgb(37, 99, 235));
          background-size: contain;
          background-repeat: no-repeat;
          background-position: right;
          
      }

      @media (max-width: 1050px) {
      .wrapper {
     
          height: 43rem;
          width: 100%;
          /* Allow the height to adjust based on content */
          background-size: contain; /* Use contain for smaller screens */
      }
    }

      @media (max-width: 768px) {
      .wrapper {
       
          height: 45rem;
          width: 100%;
          /* Allow the height to adjust based on content */
          background-size: contain; /* Use contain for smaller screens */
      }

  }

 

  #menu-toggle:checked + #menu {
        display: block;
      }

  </style>

</head>

 <body class="bg-gray-100 flex flex-col min-h-screen justify-center">

  <header class="lg:px-16 px-6 bg-violet-700 flex flex-wrap items-center lg:py-0 py-2">
    <div class="flex-1 flex justify-between items-center my-4">
      <a href="#">
        <img class='h-14 inline ml-10' src="../images/newlogo.png" alt=""/>
    </a>
  </div>

   <label for="menu-toggle" class="pointer-cursor lg:hidden block"><svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg></label>
  <input class="hidden" type="checkbox" id="menu-toggle" />

  <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
    <nav>
      <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0 font-bold">
        <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 text-gray-200" href="{{route('homepage')}}">HOME</a></li>
        <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 text-gray-200" href="{{route('productpage')}}">PRODUCTS</a></li>
        <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 text-gray-200" href="{{route('servicepage')}}">SERVICES</a></li>
        <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 lg:mb-0 mb-2 text-gray-200" href="{{route('aboutuspage')}}">ABOUT US</a></li>

        @guest('customers')
        <li class='mx-4 my-6 md:my-0'>
            <a href="{{ route('loginpage') }}" class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 lg:mb-0 mb-2 text-gray-200">LOGIN</a>
        </li>
        @else
        <li><a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-amber-500 lg:mb-0 mb-2 text-gray-200" href="{{route('shoppingcart')}}"><i class="fa-solid fa-cart-shopping text-xl"></i>
       
        {{-- @if($cartAllQuantity > 0) --}}
        <span class="text-amber-500">+{{ session('cartAllQuantity',0) }}</span>
        {{-- @endif --}}
        </a></li>
        <li class='mx-4 my-6 md:my-0'>
          
            <div class="sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                          <span class="capitalize">{{auth('customers') -> user() -> name}}</span>
    
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
    
                    <x-slot name="content">
                        {{-- <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link> --}}

                        {{-- <x-dropdown-link :href="route('shoppingcart')">
                         {{ __('Shopping Cart') }}
                        </x-dropdown-link> --}}
                        <x-dropdown-link :href="route('showallcustomerorder')">
                          {{ __('Your Orders') }}
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

  </div>

  </header>
            <main>
              <div class="">
                @yield('content')
               </div>
            </main>

        <footer class="mt-auto">  
        {{-- <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220"><path fill="rgb(109 40 217)" fill-opacity="1" d="M0,160L80,154.7C160,149,320,139,480,144C640,149,800,171,960,154.7C1120,139,1280,85,1360,58.7L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
        </svg> --}}
        <div class="px-16 lg:px-10 sm:px-0 md:pb-6 bord py-12">
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

    {{-- <script>
      document.addEventListener("DOMContentLoaded", function () {
          // Function to fetch and update cart quantity
          function updateCartQuantity() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "{{ route('shoppingcart') }}"); // Replace with your route for fetching cart quantity
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the cart quantity in the navbar
            var cartQuantity = JSON.parse(xhr.responseText);
            document.getElementById("cart-quantity").textContent = cartQuantity;
        }
    };
    xhr.send();
}

updateCartQuantity();

// Set an interval to periodically update the cart quantity (e.g., every 30 seconds)
setInterval(updateCartQuantity, 30000); // Update every 30 seconds, adjust as needed
        
      });
  </script> --}}

  <script>
    wow = new WOW(
                      {
                      boxClass:     'wow',      // default
                      animateClass: 'animated', // default
                      offset:       100,          // default
                      mobile:       true,       // default
                      live:         true        // default
                      
                    }
                    )
                    wow.init();
</script>
              

     </body>

     
</html>

