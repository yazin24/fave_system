@extends('sales.sales_home')

@section('sales-body')

<h2 class="font-bold md:text-xl mt-2">Shopee And Lazada</h2>

<div class="flex flex-row gap-2 justify-end">
    
    <div>
            <button class="bg-orange-600 hover:bg-orange-700 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('shopeesalesform')}}">Shopee</a></button>
    </div>

    <div>
            <button class="bg-blue-900 hover:bg-blue-800 font-bold text-gray-200 p-1 rounded-sm text-xs shadow-md"><a href="{{route('lazadasalesform')}}">Lazada</a></button>
    </div>

</div>

@endsection