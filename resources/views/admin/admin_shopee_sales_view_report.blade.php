@extends('admin.admin_home')

@section('admin-body')


<form method="POST" action="{{route('generateshopeesalesreport')}}">
    @csrf
    <div class="flex flex-row items-center gap-1">
       
        <select class="text-xs rounded-sm" name="date_interval" id="date_interval">
            <option disabled selected>----------------------</option>
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
            <option value="quarterly">Quarterly</option>
            <option value="yearly">Yearly</option>
        </select>
        <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold p-1.5 text-gray-200 rounded-md"><i class="fa-solid fa-right-to-bracket"></i> Generate</button>
    </div>
</form>

@if(isset($allShopeeOrders))
<div class="mt-4 w-full">
    <div class="flex justify-end font-semibold">
        <button class="flex justify-end bg-teal-500 hover:bg-teal-600 p-1 rounded-sm text-gray-200 mb-1 text-center"><i class="fa-solid fa-file-arrow-down mr-1 mt-1"></i> Download</button>
    </div>
    
    <table class="w-full">
        <thead class="bg-orange-600 h-8 text-gray-200">
            <tr>
                <th class="w-1/6">ID</th>
                <th class="w-1/6">NAME</th>
                <th class="w-1/6">STATUS</th>
                <th class="w-1/6">DATE</th>
                <th class="w-1/6">AMOUNT</th>
                <th class="w-1/6">ITEMS</th>
            </tr>
        </thead>
        <tbody class="text-center bg-gray-200 shadow-sm h-6">
            @foreach ($allShopeeOrders as $shopeeOrder)
            <tr>
                <td>{{$shopeeOrder -> total_amount}}</td>
                <td>{{$shopeeOrder -> shopeeOrders -> customers_name}}</td>
                <td>s</td>
                <td>s</td>
                <td>s</td>
                <td>s</td>
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
@endif

@endsection