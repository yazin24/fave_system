@extends('receiving.receiving_home')

@section('receiving-body')

<h2 class="font-bold md:text-xl mt-2">Input Product</h2>

<label for="barcode">Scan Barcode:</label>
    <input type="text" name="barcode" id="barcode">
    <button type="submit">Submit</button>

@endsection