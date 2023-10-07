@extends('ecommerce.navbar')

@section('content')

<div class=" flex justify-center mt-24">

<div class="grid grid-cols-1 gap-12 md:grid md:grid-cols-2 gap-12 lg:grid lg:grid-cols-4 gap-12 justify-center">
@foreach ($allProducts as $product)
<div class="flex justify-center  rounded-sm w-72 mb-8 p-4 bg-gray-100 shadow-lg hover:scale-[1.05] hover: !scale-100!important duration-100">
  <div  class="w-72">
    <img src="{{asset($product -> image_path)}}">
    <h2 class="mt-8 font-bold text-violet-700">₱{{$product -> retail_price}}</h2>
    @if(auth('customers') -> check())

    <form method="POST" action="{{route('addtocart', ['product' => $product -> id])}}">
      @csrf
        <button id="openModalBtn" type="submit" class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
          <!-- Modal Background -->
         
          <div id="modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white w-1/2 p-6 rounded shadow-lg">
              <span id="closeModalBtn" class="close absolute top-0 right-0 m-4 cursor-pointer text-gray-600 hover:text-gray-800">×</span>
              <h2 class="text-2xl font-semibold mb-4">Modal Title</h2>
              <p>Modal content goes here.</p>
            </div>
          </div>
      
    </form>
    

    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full"><a href="{{route('buynoworderdetails', ['productId' => $product -> id])}}">Buy Now</a></button>
    @else
    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><a href="{{route('loginpage')}}"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</a></button>
    
    <button class="bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full"><a href="{{route('loginpage')}}">Buy Now</a></button>
    @endif
  </div>
</div>


@endforeach

</div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Get references to the modal and buttons
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("openModalBtn");
    const closeModalBtn = document.getElementById("closeModalBtn");

    // Function to open the modal
    function openModal() {
      modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
      modal.style.display = "none";
    }

    // Open the modal when the button is clicked
    openModalBtn.addEventListener("click", openModal);

    // Close the modal when the close button or background is clicked
    closeModalBtn.addEventListener("click", closeModal);
    modal.addEventListener("click", function (event) {
      if (event.target === modal) {
        closeModal();
      }
    });
  });
</script>

@endsection