<x-guest-layout>
    <div class="flex justify-center h-16">
        <img src="{{ asset('images/newfavelogo.png') }}" alt="Example Image">
        </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4 text-xs">
            <x-input-label for="usertype" :value="__('Usertype')" class="text-xs"/>
            <select id="usertype" name="usertype" class="block mt-1 w-1/2 text-xs border rounded-md border-gray-300" required autocomplete="username">
                <option value="" disabled selected>Select Usertype</option>
                <option value="admin" @if(old('usertype') === 'admin') selected @endif>Admin</option>
                <option value="inventory" @if(old('usertype') === 'inventory') selected @endif>Inventory</option>
                <option value="purchasing" @if(old('usertype') === 'purchasing') selected @endif>Purchasing</option>
                <option value="receiving" @if(old('usertype') === 'receiving') selected @endif>Receiving</option>
                <option value="sales" @if(old('usertype') === 'sales') selected @endif>Sales</option>
                <option value="sales_agent" @if(old('usertype') === 'sales_agent') selected @endif>Sales Agent</option>
            </select>
            <x-input-error :messages="$errors->get('usertype')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
