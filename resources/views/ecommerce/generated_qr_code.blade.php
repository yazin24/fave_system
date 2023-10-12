@extends('ecommerce.navbar')

@section('content')

    <div class="my-24 flex justify-center">
        <div class="">
          <img src="{{asset('images/qrcode_gcash.jpg')}}">
          <h2 class="text-red-600 font-bold">Instructions: Please input the amount in gcash <br>and complete the transaction.</h2>
          <div>
            {{-- <h2>Details: x{{$productId -> quantity}}</h2> --}}
            <h2>Variant: {{$productId -> full_name}}</h2>
            <h2>Total Amount:</h2>
          </div>
        </div>
    </div>

@endsection