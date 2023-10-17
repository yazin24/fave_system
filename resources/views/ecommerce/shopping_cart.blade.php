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
                    
                    {{-- <form method="POST" action="{{route('deleteiteminshoppingcart', ['item' => $item -> id])}}">
                      @csrf
                      @method('DELETE') --}}
                      <button class="modal-open mr-2 bg-red-500 hover:bg-red-600 text-gray-200 p-1.5 rounded-sm" onclick="return confirm('Do you really want to delete this item?')">
                        <a href="{{route('deleteiteminshoppingcart', ['item' => $item -> id])}}"><i class="fa-solid fa-trash"></i></a>
                        </button>
                    {{-- </form> --}}
                   
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
     <select name="payment_method" class="h-8 text-xs w-full rounded-sm" required>
      <option disabled selected>Choose Payment method</option>
      <option value="Cash On Delivery">Cash On Delivery</option>
      <option value="Gcash">Gcash</option>
      {{-- <option disabled selected>Maya</option> --}}
      <option value="Paypal">Paypal</option>
         {{-- <option>Cash On Delivery</option>
         <option>Cash On Delivery</option> --}}
     </select>

       
    </div>
  </div>
  <button type="submit" class="bg-teal-500 mt-1 hover:bg-teal-600 p-1 rounded-sm text-gray-200 font-bold text-xs mb-20">Place Order</button>
</div>
</form>

</div>

<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
  
  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
    
    {{-- <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
      <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
      </svg>
      <span class="text-sm">(Esc)</span>
    </div> --}}

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