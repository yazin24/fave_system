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
        <button type="submit" class="modal-open bg-violet-700 hover:bg-violet-800 text-gray-200 p-1 rounded-sm font-bold w-full mb-1"><i class="fa-solid fa-cart-shopping"></i> Add To Cart</button>
          <!-- Modal Background -->
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

<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    
    <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
      <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      <span class="text-sm">(Esc)</span>
    </div>

    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-center items-center pb-3">
        <i class="fa-regular fa-circle-check fa-2xl text-teal-600"></i>
        <p class="text-2xl font-bold text-teal-600">Added To Cart</p>
       
      </div>

      <!--Footer-->
      <div class="flex justify-center pt-2">
        <button class="modal-close px-4 bg-violet-500 hover:bg-violet-600 p-1 rounded-sm text-white hover:bg-indigo-400" onclick="refreshPage()">Close</button>
      </div>
      
    </div>
  </div>
</div>


<script>
  var openmodal = document.querySelectorAll('.modal-open');
  for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function (event) {
      // Prevent default action only if the clicked element has the 'modal-open' class.
      if (event.target.classList.contains('modal-open')) {
        event.preventDefault();
        toggleModal();
      }
    });
  }
  
  const overlay = document.querySelector('.modal-overlay')
  overlay.addEventListener('click', toggleModal)
  
  var closemodal = document.querySelectorAll('.modal-close')
  for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', toggleModal)
  }
  
  document.onkeydown = function(evt) {
    evt = evt || window.event
    var isEscape = false
    if ("key" in evt) {
      isEscape = (evt.key === "Escape" || evt.key === "Esc")
    } else {
      isEscape = (evt.keyCode === 27)
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
      toggleModal()
    }
  };

  // Handle form submission for add to cart buttons
  var addToCartButtons = document.querySelectorAll('.modal-open');
  for (var i = 0; i < addToCartButtons.length; i++) {
    addToCartButtons[i].addEventListener('click', function (event) {
      // Prevent default action only if the clicked element has the 'modal-open' class.
      if (event.target.classList.contains('modal-open')) {
        event.preventDefault();
        // Handle the form submission here
        var form = event.target.closest('form');
        if (form) {
          form.submit();
        }
      }
    });
  }

  function toggleModal () {
    const body = document.querySelector('body')
    const modal = document.querySelector('.modal')
    modal.classList.toggle('opacity-0')
    modal.classList.toggle('pointer-events-none')
    body.classList.toggle('modal-active')
  }

  function refreshPage() {
    // Reload the page when the button is clicked
    location.reload();
    location.reload();
  }
</script>

@endsection