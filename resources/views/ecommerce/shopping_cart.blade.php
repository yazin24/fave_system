@extends('ecommerce.navbar')

@section('content')

<div class="flex justify-center mx-8">
<form method="POST" action="{{route('placeorder')}}" class="flex justify-center">
  @csrf
  <div class="">
  <table class="bg-gray-200 shadow-lg md:w-1/3 mt-8" style="table-layout: fixed;">
    
      <thead>
          <tr class="bg-violet-700 w-full text-gray-200 h-12">
            <th class="text-sm text-center w-1/5">ACTION</th>
              <th class="text-sm text-center w-1/5">ITEM</th>
              <th class="text-sm text-center w-1/5">QUANTITY</th>
              <th class="text-sm text-center w-1/5">PRICE</th>
              <th class="text-sm text-center w-1/5">AMOUNT</th>
          </tr>
      </thead>
      <tbody>
        @foreach($allItemCart as $item)
              <tr class="h-24 font-bold">

                <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><input type="checkbox" name="order_products[]" value="{{$item -> sku_id}}" class="w-6 h-6"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><img src="{{asset($item -> productSku -> image_path)}}" class="w-24 text-center"><input type="hidden" name="product_id[{{$item -> sku_id}}]" value="{{$item -> sku_id}}"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><input type="number" class="h-6 w-14" name="product_quantity[{{$item -> sku_id}}]" value="{{$item -> quantity}}" class=" text-center w-24"></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5"><input type="number" class="h-6 w-20 px-0 text-center" name="product_price[{{$item -> sku_id}}]" value="{{$item -> price}}" readonly></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5">₱{{$item -> price * $item -> quantity}}.00</td>
                  
              </tr>
              @endforeach
              <hr>
      </tbody>
  </table>
  @if(session('error'))
    <div class="alert alert-danger text-red-600 text-xs font-bold">
        {{ session('error') }}
    </div>
@endif
  <div class="mt-4">
    <div class="flex flex-col md:w-1/3">
       
      @if(auth('customers') -> check())
      <input type="number" name="phone_number" value="{{auth('customers') -> user() -> phone_number}}" class="h-8 text-xs mb-1 w-full rounded-sm" required>
     {{-- <input type="text" name="billing address" placeholder="billing" required> --}}
     @endif
     <input type="text" name="shipping address" placeholder="Shipping Address" class="h-8 text-xs mb-1 w-full rounded-sm" required>
     <select name="payment_method" class="h-8 text-xs w-full rounded-sm">
      <option disabled selected>Choose Payment method</option>
      <option value="Cash On Delivery">Cash On Delivery</option>
      <option value="Gcash">Gcash</option>
      <option disabled selected>Maya</option>
      <option value="Paypal">Paypal</option>
         {{-- <option>Cash On Delivery</option>
         <option>Cash On Delivery</option> --}}
     </select>

       
    </div>
  </div>
  <button type="submit" class="bg-teal-500 mt-1 hover:bg-teal-600 p-1 rounded-sm text-gray-200 font-bold text-xs">Place Order</button>
</div>
</form>
</div>

@endsection