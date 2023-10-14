@extends('admin.admin_home')

@section('admin-body')


<form method="POST" action="{{route('generateshopeesalesreport')}}">
    @csrf
    <div class="flex flex-row items-start gap-1">
       <label>From:</label>
       <input type="date" name="start_date" class="text-xs">
       <label>To:</label>
       <input type="date" name="end_date" class="text-xs">
        <button type="submit" class="bg-teal-500 hover:bg-teal-600 font-bold p-1.5 text-gray-200 rounded-md text-xs mt-1"><i class="fa-solid fa-right-to-bracket"></i> Generate</button>
    </div>
</form>

@if(isset($allShopeeOrders))
<div class="mt-4 w-full">
    <div class="flex justify-end font-semibold">
        <button class="flex justify-end bg-teal-500 hover:bg-teal-600 p-1 rounded-sm text-gray-200 mb-1 text-center text-xs"><i class="fa-solid fa-file-arrow-down mr-1 mt-0.5"></i> Download</button>
    </div>
    
    <table class="w-full mb-24">
        <thead class="bg-orange-600 h-8 text-gray-200">
            <tr class="">
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
            <tr class="border border-b-600 border-gray-300 h-12">
                <td>{{$shopeeOrder -> shopeeOrders -> order_id}}</td>
                <td>{{$shopeeOrder -> shopeeOrders -> customers_name}}</td>
                <td>
                    @if($shopeeOrder -> shopeeOrders -> status == 4) Complete
                    @elseif($shopeeOrder -> shopeeOrders -> status == 8) Cancelled
                    @elseif($shopeeOrder -> shopeeOrders -> status == 9) Ongoing
                    @elseif($shopeeOrder -> shopeeOrders -> status == 3) Queued
                    @elseif($shopeeOrder -> shopeeOrders -> status == 7) Undelivered
                    @endif
                </td>
                <td>{{date('d-m-y', strtotime($shopeeOrder -> created_at))}}</td>
                <td>₱{{number_format($shopeeOrder -> total_amount, 2)}}</td>

               <td>
                <ul class="text-xs">
                    @foreach($shopeeOrder-> shopeeOrders -> shopeeOrderProducts as $item)
                        <li>{{$item->productSku->full_name}} <span class="text-red-600 font-bold">({{$item -> quantity}})</span></li>
                    @endforeach
                </ul>
               </td>
                
            </tr>
            @endforeach
           
        </tbody>
    </table>
</div>
@endif

{{-- <div class="mt-1 ml-2">
    {{ $allShopeeOrders->onEachSide(1)->appends(['method' => 'POST'])->links() }}
</div> --}}

@endsection