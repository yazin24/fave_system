@extends('ecommerce.navbar')

@section('content')

<div class="grid grid-cols-3 gap-4">
@foreach ($allProducts as $product)
<div class="border border-gray-900 rounded-sm">
  <div  class="w-72">
    <img src="{{asset($product -> image_path)}}">
    <h2>₱{{$product -> retail_price}}</h2>
    <button class="bg-violet-700 text-gray-200 p-1 rounded-sm font-bold w-full mb-1">Add To Cart</button>
    <button class="bg-violet-700 text-gray-200 p-1 rounded-sm font-bold w-full">Buy Now</button>
  </div>
</div>
@endforeach


</div>

@endsection