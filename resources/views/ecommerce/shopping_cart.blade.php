@extends('ecommerce.navbar')

@section('content')


<div class="flex justify-center mt-10">
<form method="POST" action="{{route('placeorder')}}">
  @csrf
  <table class="bg-gray-200 shadow-lg w-3/4">
    
      <thead>
          <tr class="md:h-12 bg-violet-700 border-b-2 text-gray-100 font-bold">
            <th class="text-sm text-center w-1/5">ACTION</th>
              <th class="text-sm text-center w-1/5">ITEM</th>
              <th class="text-sm text-center w-1/5">QUANTITY</th>
              <th class="text-sm text-center w-1/5">PRICE</th>
              <th class="text-sm text-center w-1/5">AMOUNT</th>
          </tr>
      </thead>
      <tbody>
        @foreach($allItemCart as $item)
              <tr class="h-12 font-bold">

                <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><input type="checkbox" name="order_products[]" value="{{$item -> sku_id}}" class="w-6 h-6"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><img src="{{asset($item -> productSku -> image_path)}}" class="w-24"></td>

                  <td class="border-b-2 border-gray-100 text-xs text-center w-1/5"><input type="number" name="product_quantity[{{$item -> id}}]" value="{{$item -> quantity}}" class=" text-center w-24"></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5"><input type="number" name="product_price[{{$item -> id}}]" value="{{$item -> price}}"></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5">P{{$item -> price * $item -> quantity}}.00</td>
                  
              </tr>
              @endforeach
              <hr>
      </tbody>
  </table>
  <div class="">
    <div class="border-gray-400 p-12 bg-gray-900 h-full font-bold">
        <h2>Total Amount: </h2>
        <input type="text" name="shipping_address" placeholder="shipping address">
        <input type="text" name="billing_address" placeholder="billing address">
       
    </div>
  </div>
  <button type="submit" class="bg-red-600 hover:bg-red-700 p-1 rounded-sm">Place Order</button>
</form>
</div>

@endsection