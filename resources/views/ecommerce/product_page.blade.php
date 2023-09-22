@extends('ecommerce.navbar')

@section('content')

<div class=" flex justify-center mt-12">

<div class="grid grid-cols-1 gap-12 md:grid md:grid-cols-2 gap-12 lg:grid lg:grid-cols-4 gap-12 justify-center">
@foreach ($allProducts as $product)
<div class="flex justify-center  rounded-sm w-72 mb-8 p-4 bg-gray-100 shadow-lg hover:scale-[1.05] hover: !scale-100!important duration-100">
  <div  class="w-72">
    <img src="{{asset($product -> image_path)}}">
    <h2 class="mt-8 font-bold text-violet-700">₱{{$product -> retail_price}}</h2>
    @if(auth('customers') -> check())
    <form method="POST" action="{{route('addtocart', ['product' => $product -> id])}}">
      <button type="submit" class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
    </form>
    

    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full"><a href="{{route('homepage')}}">Buy Now</a></button>
    @else
    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><a href="{{route('loginpage')}}"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</a></button>

    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full"><a href="{{route('loginpage')}}">Buy Now</a></button>
    @endif
  </div>
</div>
@endforeach

</div>

</div>

@endsection