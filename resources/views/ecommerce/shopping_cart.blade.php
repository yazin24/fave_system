@extends('ecommerce.navbar')

@section('content')

<div>
  <table>
    <thead>
      <tr>
        <th>Product</th>
        <th>Variant</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>photo</td>
        <td>calamansi</td>
        <td>1L</td>
        <td><input type="number" value="2"></td>
        <td>35.00</td>
        <td>100.00</td>
      </tr>
    </tbody>
   
  </table>
</div>

@endsection