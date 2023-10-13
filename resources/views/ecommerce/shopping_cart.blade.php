@extends('ecommerce.navbar')

@section('content')

<form method="POST" action="{{route('placeorder')}}">
  @csrf
  <div class="flex flex-col justify-center w-full px-2 sm:px-12 md:px-78 lg:px-96">
  <table class="mt-20 border border-gray-200 shadow-sm">
      <thead>
          <tr class="bg-violet-700 w-full text-gray-200 h-12">
            <th class="text-sm text-center w-1/6">ACTION</th>
              <th class="text-sm text-center w-1/6">ITEM</th>
              <th class="text-sm text-center w-1/6">QUANTITY</th>
              <th class="text-sm text-center w-1/6">PRICE</th>
              <th class="text-sm text-center w-1/6">AMOUNT</th>
              <th class="text-sm text-center w-1/6">DELETE</th>
          </tr>
      </thead>
      <tbody>
        @foreach($allItemCart as $item)
              <tr class="h-24 font-bold gap-2">

                <td class="border-b-2 border-gray-100 text-xs text-center w-1/6">
                  
                  <input type="checkbox" name="order_products[]" value="{{$item -> sku_id}}" class="w-6 h-6 rounded-md"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/6"><img src="{{asset($item -> productSku -> image_path)}}" class="w-24 text-center"><input type="hidden" name="product_id[{{$item -> sku_id}}]" value="{{$item -> sku_id}}"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/6"><input type="number" class="h-6 w-14" name="product_quantity[{{$item -> sku_id}}]" value="{{$item -> quantity}}" class=" text-center w-24"></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/6"><input type="number" class="h-6 w-20 px-0 text-center" name="product_price[{{$item -> sku_id}}]" value="{{$item -> price}}" readonly></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/6">₱{{$item -> price * $item -> quantity}}.00</td>

                   <td class="border-b-2 border-gray-100 text-md text-center w-1/6">
                    <form method="POST" action="{{route('deleteiteminshoppingcart', ['allItemCart' => $allItemCart -> id])}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="mr-2 bg-red-500 hover:bg-red-600 text-gray-200 p-1.5 rounded-sm" onclick="return confirm('Do you really want to delete this item?')"><i class="fa-solid fa-trash"></i></button>
                    </form>
                   
                  </td>
                  
                  
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
  <div class="mt-1">
    <div class="flex flex-col">
       
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
  <button type="submit" class="bg-teal-500 mt-1 hover:bg-teal-600 p-1 rounded-sm text-gray-200 font-bold text-xs mb-20">Place Order</button>
</div>
</form>

@endsection