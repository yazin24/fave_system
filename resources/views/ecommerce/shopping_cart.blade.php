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

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5"><input type="number" class="h-6 w-20 px-0 text-center" name="product_price[{{$item -> sku_id}}]" value="{{$item -> price}}"></td>

                  <td class="border-b-2 border-gray-100 text-md text-center w-1/5">₱{{$item -> price * $item -> quantity}}.00</td>
                  
              </tr>
              @endforeach
              <hr>
      </tbody>
  </table>
  <div class="mt-4">
    <div class="flex flex-col md:w-1/3">
       
        <input type="text" name="shipping_address" placeholder="shipping address" class="mb-1 rounded-sm h-8">
        <input type="text" name="billing_address" placeholder="billing address" class="mb-1 rounded-sm h-8">
       
    </div>
  </div>
  <button type="submit" class="bg-teal-500 hover:bg-teal-600 p-1 rounded-sm text-gray-200 font-bold text-xs">Place Order</button>
</div>
</form>
</div>

@endsection