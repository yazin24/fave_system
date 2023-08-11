<nav x-data="{ open: false }" class="bg-gray-900 dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="mr-6 lg:px-8">
        <div class="flex justify-between h-12 md:h-16">
            <div class="flex">
                <!-- Logo -->

                <!-- Navigation Links -->
                <div class="hidden sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-blue-500 text-xl font-extrabold">
                        <img src="{{ asset('images/newfavelogo.png') }}" alt="Example Image" class="w-16 ml-4 mr-1"> 
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 ">
                            <div class="capitalize">{{ Auth::user()->name }}</div>

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

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class=" pb-3 flex flex-row justify-between">

            @if(Auth::user()->usertype === 'admin')
            <x-responsive-nav-link :href="route('adminpurchasingmonitoring')" :active="request()->routeIs('adminpurchasingmonitoring')">
                <i class="fa-solid fa-rectangle-list text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adminpurchaseapproval')" :active="request()->routeIs('adminpurchaseapproval')">
                <i class="fa-solid fa-clipboard-question text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adminsupplierlist')" :active="request()->routeIs('adminsupplierlist')">
                <i class="fa-solid fa-address-book 2xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adminunpurchase')" :active="request()->routeIs('adminunpurchase')">
                <i class="fa-solid fa-link-slash text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('adminstockmonitoring')" :active="request()->routeIs('adminstockmonitoring')">
                <i class="fa-solid fa-layer-group text-xl"></i>
            </x-responsive-nav-link>
        <x-responsive-nav-link :href="route('adminoutgoingstocks')" :active="request()->routeIs('adminoutgoingstocks')">
            <i class="fa-solid fa-outdent text-xl"></i>
        </x-responsive-nav-link>
            
            
            @elseif(Auth::user()->usertype === 'purchasing')
            <x-responsive-nav-link :href="route('purchasemonitoring')" :active="request()->routeIs('purchasemonitoring')">
                <i class="fa-solid fa-rectangle-list text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('purchase')" :active="request()->routeIs('purchase')">
                <i class="fa-solid fa-file-circle-plus text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('allpurchases')" :active="request()->routeIs('allpurchases')">
                <i class="fa-solid fa-eye text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('addsupplier')" :active="request()->routeIs('addsupplier')">
                <i class="fa-solid fa-folder-plus"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('purchasingsupplierlist')" :active="request()->routeIs('purchasingsupplierlist')">
                <i class="fa-solid fa-address-book 2xl"></i>
            </x-responsive-nav-link>
        
        @elseif(Auth::user()->usertype === 'receiving')
            <x-responsive-nav-link :href="route('productinput')" :active="request()->routeIs('productinput')">
                <i class="fa-solid fa-cubes-stacked text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('receivedpomonitoring')" :active="request()->routeIs('receivedpomonitoring')">
                <i class="fa-solid fa-desktop text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('receivepo')" :active="request()->routeIs('receivepo')">
                <i class="fa-solid fa-file-medical text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pulloutmonitoring')" :active="request()->routeIs('pulloutmonitoring')">
                <i class="fa-solid fa-outdent text-xl"></i>
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pullout')" :active="request()->routeIs('pullout')">
                <i class="fa-solid fa-upload text-xl"></i>
            </x-responsive-nav-link>
        
        @elseif(Auth::user()->usertype === 'staff')
            <x-responsive-nav-link :href="route('staffallpurchases')" :active="request()->routeIs('staffallpurchases')">
               All Purchases
            </x-responsive-nav-link>
           
            @endif
    </div>

        <!-- Responsive Settings ptions -->
        <div class="pb-1 border-t border-gray-200 dark:border-gray-600">
            {{-- <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div> --}}

            <div class="flex justify-end">
                {{-- <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
