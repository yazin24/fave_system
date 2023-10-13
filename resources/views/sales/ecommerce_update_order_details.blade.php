@extends('sales.sales_home')

@section('sales-body')

<div>
    <div class="bg-gray-300 p-2 w-full md:w-1/3 rounded-sm shadow-sm">
        <form method="POST" action="{{route('orderdetailsupdate', ['ecommerceOrder' => $ecommerceOrder -> id])}}">
            @csrf
            @method('PUT')
            <h2 class="font-semibold mb-2">Status: Queued -> Ongoing</h2>
            <label>Ref Number:</label>
            <input type="string" class="rounded-sm" name="ref_number"><br>
            <button type="submit" class="mt-4 bg-teal-500 text-gray-200 hover:bg-teal-600 p-1 rounded-sm text-xs" onclick="return confirm('Update to fully paid now?')">Submit</button>
        </form>
   
    </div>
</div>


@endsection