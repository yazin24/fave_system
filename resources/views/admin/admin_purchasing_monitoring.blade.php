@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">Purchasing Monitoring</h2>


    <div class="flex flex-row mb-2">

        <form method="GET" action="{{route('adminsearch')}}">
        
        <div class="flex flex-row mt-4">
                <input type="text" name="search" placeholder="Search here">
            <div>
                <button type="submit" class="mt-2 bg-green-400 hover:bg-blue-600 rounded-md p-1 text-gray-200 shadow-md ml-4 text-sm">Search</button>
            </div>
        </div>
        </form>
        
        <div class="flex mt-7">
            <button class="bg-blue-400 text-gray-100 text-xs rounded-md shadow-md hover:bg-blue-600 p-1" onclick="window.location.reload()">Refresh</button>
        </div>

    </div>

    {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

        <div>
            @if(session() -> has('success'))
            {{session('success')}}
            @endif
        </div>

        {{-- ---------------------------------------------------------------------------------------------------------------------------------------- --}}

    @if(isset($allPurchaseOrders))
    @if($allPurchaseOrders -> count() > 0)
    <div class="">
        <div>
            <table class="bg-gray-300 shadow-lg w-full">

                <thead>
                    <tr class="bg-gray-900 border-b-2 text-gray-300">
                    <th class="text-center">PO_NUMBER</th>
                    <th class="text-center">SUPPLIER</th>
                    <th class="text-center">REQUESTED_BY</th>
                    <th class="text-center">PREPARED_BY</th>
                    <th class="text-center">APPROVED_BY</th>
                    <th class="text-center">STATUS</th>
                    <th class="text-center">DATE_CREATED</th>
                    <th class="text-center">ACTION</th>
                    </tr>
                </thead>

            <tbody>
                    @foreach ($allPurchaseOrders as $allPurchaseOrder)
                    <tr class="h-10">
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> po_number}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> requested_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> purchaseOrderCredentials -> approved_by}}</td>
                    <td class="border-b-2 text-sm text-center capitalize">{{$allPurchaseOrder -> systemStatus -> status}}</td>
                    <td class="border-b-2 text-sm text-center">{{$allPurchaseOrder -> created_at -> format('Y-m-d h:i:s A')}}</td>

                    <td class="border-b-2 text-sm text-center">
                        <div class="flex flex-row justify-center items-center">

                            <div class="bg-yellow-500 p-1 mr-2 rounded-md shadow-md">
                                <button onclick="openModalDetails(
                                '{{$allPurchaseOrder -> po_number}}',
                                '{{$allPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}',
                                '{{$allPurchaseOrder -> purchaseOrderCredentials -> requested_by}}',
                                '{{$allPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}',
                                '{{$allPurchaseOrder -> purchaseOrderCredentials -> approved_by}}',
                                '{{$allPurchaseOrder -> systemStatus -> status}}',
                                [
                                    @foreach($allPurchaseOrder -> purchaseOrderItems as $item)
                                    '{{$item -> item_name}}',
                                    @endforeach
                                ]
                                )"><i class="fa-solid fa-eye"></i></button>
                            </div>

                            <div class="bg-red-500 p-1 rounded-md shadow-md">
                                <form method="POST" action="{{route('adminpurchaseorderdelete', ['allPurchaseOrder' => $allPurchaseOrder, 'id' => $allPurchaseOrder -> id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>

                        </div>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 font-bold">
        {{$allPurchaseOrders -> links()}}
    </div>
    @else
    {{-- <p>No Results Found</p> --}}
    @endif
    @endif
</div>

<div id="modal_details" class="hidden fixed top-0 left-0 w-full h-full flex items-start justify-center pt-40 bg-gray-900 bg-opacity-80">
    <div class="bg-white rounded-lg p-8">
        <h2 class="font-bold text-xl">Purchase Order Details</h2>
        <p>PO Number:<span id="po_number"></span></p>
        <p>Supplier:<span id="supplier"></span></p>
        <p>Requested By:<span id="requested_by"></span></p>
        <p>Prepared By:<span id="prepared_by"></span></p>
        <p>Approved By:<span id="approved_by"></span></p>
        <p>Status:<span id="status"></span></p>
        <p>Item:</p>
        <ul id="item_list"></ul>

        <button id="close_modal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-md">Close</button>
    </div>

</div>

    <script>
        function openModalDetails(poNumber, supplier, requestedBy, preparedBy, approvedBy, status, items){
            document.getElementById('po_number').textContent = poNumber;
            document.getElementById('supplier').textContent = supplier;
            document.getElementById('requested_by').textContent = requestedBy;
            document.getElementById('prepared_by').textContent = preparedBy;
            document.getElementById('approved_by').textContent = approvedBy;
            document.getElementById('status').textContent = status;
            
            var itemList = document.getElementById('item_list');

            itemList.innerHTML = '';

            items.forEach(function(item){
                var li = document.createElement('li');
                li.textContent = item;
                itemList.appendChild(li);
            });

            document.getElementById('modal_details').classList.remove('hidden');
        }

        document.getElementById('close_modal').addEventListener('click', function(){
            document.getElementById('modal_details').classList.add('hidden');
        });
    </script>


@endsection