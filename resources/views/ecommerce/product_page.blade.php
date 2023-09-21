@extends('ecommerce.navbar')

@section('content')

<div class=" flex justify-center mt-12">

<div class="grid grid-cols-1 gap-12 md:grid md:grid-cols-2 gap-12 lg:grid lg:grid-cols-4 gap-12 justify-center">
@foreach ($allProducts as $product)
<div class="flex justify-center  rounded-sm w-72 mb-8 p-4 bg-gray-100 shadow-lg hover:scale-[1.05] hover: !scale-100!important duration-100">
  <div  class="w-72">
    <img src="{{asset($product -> image_path)}}">
    <h2 class="mt-8">₱{{$product -> retail_price}}</h2>
    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full">Buy Now</button>
  </div>
</div>
@endforeach

</div>

</div>

@endsection