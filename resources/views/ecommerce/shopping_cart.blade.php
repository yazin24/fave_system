@extends('ecommerce.navbar')

@section('content')

<div class=" h-screen p-10 px-40">
    <h2 class="text-2xl font-bold">Shopping Cart</h2>
    <div class="flex flex-row sm:space-x-4 md:justify-between md:items-center border-solid p-2 px-6 border-2 border-slate-100 bg-gray-700 text-lg text-white w-4/6">
          <p>Product</p>
          <p>Quantity</p>
          <p>Price</p>
          <p>Total</p>
      </div>

      <div class="flex flex-col md:flex-row h-3/4">
        <div class="border-solid border-2 border-slate-100 bg-gray-100 text-lg text-white mt-0 w-4/6 space-y-4 px-4"> 
          <div class="flex flex-col md:flex-row justify-between">
            <p class="text-gray-900">Items</p>
            <div>
                <button id="decrement-button" class="px-3 py-1 bg-gray-400 text-gray-900 rounded-l hover:bg-amber-500 focus:outline-none">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 12H4"
                    ></path>
                  </svg>
                </button>
                  <input
                    id="quantity-input"
                    class="w-16 text-center text-gray-900 bg-gray-100 border-t border-b border-gray-200"
                    type="number"
                    min="1"
                    value="1"/>
                  <button id="increment-button" class="px-3 py-1 bg-gray-200 text-gray-600 rounded-r hover:bg-amber-500 focus:outline-none">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-5 h-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                      ></path>
                    </svg>
                  </button>
                </div>
                  <p class="text-gray-900">500.00</p>
                  <p class="text-gray-900">500.00</p>
          </div>

          <div class="flex flex-col md:flex-row justify-between">
            <p class="text-gray-900">Items</p>
            <div>
                <button id="decrement-button" class="px-3 py-1 bg-gray-400 text-gray-900 rounded-l hover:bg-amber-500 focus:outline-none">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 12H4"
                    ></path>
                  </svg>
                </button>
                  <input
                    id="quantity-input"
                    class="w-16 text-center text-gray-900 bg-gray-100 border-t border-b border-gray-200"
                    type="number"
                    min="1"
                    value="1"/>
                  <button id="increment-button" class="px-3 py-1 bg-gray-200 text-gray-600 rounded-r hover:bg-amber-500 focus:outline-none">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-5 h-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                      ></path>
                    </svg>
                  </button>
                </div>
                  <p class="text-gray-900">500.00</p>
                  <p class="text-gray-900">500.00</p>
          </div>

          <div class="flex flex-col md:flex-row justify-between">
            <p class="text-gray-900">Items</p>
            <div>
                <button id="decrement-button" class="px-3 py-1 bg-gray-400 text-gray-900 rounded-l hover:bg-amber-500 focus:outline-none">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 12H4"
                    ></path>
                  </svg>
                </button>
                  <input
                    id="quantity-input"
                    class="w-16 text-center text-gray-900 bg-gray-100 border-t border-b border-gray-200"
                    type="number"
                    min="1"
                    value="1"/>
                  <button id="increment-button" class="px-3 py-1 bg-gray-200 text-gray-600 rounded-r hover:bg-amber-500 focus:outline-none">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-5 h-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                      ></path>
                    </svg>
                  </button>
                </div>
                  <p class="text-gray-900">500.00</p>
                  <p class="text-gray-900">500.00</p>
          </div>

          <div class="flex flex-col md:flex-row justify-between">
            <p class="text-gray-900">Items</p>
            <div>
                <button id="decrement-button" class="px-3 py-1 bg-gray-400 text-gray-900 rounded-l hover:bg-amber-500 focus:outline-none">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M20 12H4"
                    ></path>
                  </svg>
                </button>
                  <input
                    id="quantity-input"
                    class="w-16 text-center text-gray-900 bg-gray-100 border-t border-b border-gray-200"
                    type="number"
                    min="1"
                    value="1"/>
                  <button id="increment-button" class="px-3 py-1 bg-gray-200 text-gray-600 rounded-r hover:bg-amber-500 focus:outline-none">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      class="w-5 h-5"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                      ></path>
                    </svg>
                  </button>
                </div>
                  <p class="text-gray-900">500.00</p>
                  <p class="text-gray-900">500.00</p>
          </div>
                    <div class="flex flex-col md:flex-row gap-2 justify-end">
                      <p class="text-gray-900 font-bold text-sm mt-1 md:pt-60">Total Payment:</p>
                      <p class="text-red-600 font-bold text-sm mt-1 md:pt-60 ">₱ 538.00</p>
                      <div class="md:ml-24">
                        <button class="col rounded-sm mb-2 text-xs text-white hover:bg-amber-500 p-2 md:mt-60">
                          <a href="{{route('checkout_order')}}">
                        Check Out
                        </a>
                        </button>
                      </div>
                    </div>

        </div>

@endsection