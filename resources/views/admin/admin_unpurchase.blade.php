@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold md:text-xl">Unpurchase Orders</h2>


<div>
    <div class="mt-4">
        <div>
            <table class="bg-gray-300 shadow-lg w-full">
                <thead>
                    <tr class="bg-gray-900 border-b-1 text-gray-300 md:h-10">
                        <th class="text-xs text-center">PO_NUMBER</th>
                        <th class="text-xs text-center">SUPPLIER</th>
                        <th class="text-xs text-center hidden md:table-cell">REQUESTED_BY</th>
                        <th class=" text-xs text-center hidden md:table-cell">PREPARED_BY</th>
                        <th class=" text-xs text-center hidden md:table-cell">APPROVED_BY</th>
                        <th class=" text-xs text-center">STATUS</th>
                        <th class="text-xs text-center">DATE</th>
                        <th class="text-xs text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unPurchaseOrders as $unPurchaseOrder)
                    <tr class="h-10">
                        <td class="border-b-2 text-xs text-center">{{$unPurchaseOrder -> po_number}}</td>
                        <td class="border-b-2 text-xs text-center">{{$unPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}</td>
                        <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$unPurchaseOrder -> purchaseOrderCredentials -> requested_by}}</td>
                        <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$unPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}</td>
                        <td class="border-b-2 text-xs text-center hidden md:table-cell">{{$unPurchaseOrder -> purchaseOrderCredentials -> approved_by}}</td>
                        <td class="border-b-2 text-xs text-center capitalize">{{$unPurchaseOrder -> systemStatus -> status}}</td>
                        <td class="border-b-2 text-xs text-center">{{$unPurchaseOrder -> created_at -> format('Y-m-d h:i:s A')}}</td>
                        <td class="border-b-2 text-xs text-center">
                            
                            
                            <div class="flex flex-row justify-center items-center">
                                <div class="bg-yellow-500 p-1 mr-2 rounded-md shadow-md"><button onclick="openModalDetails(
                                    '{{$unPurchaseOrder -> po_number}}',
                                    '{{$unPurchaseOrder -> purchaseOrderSupplier -> supplier_name}}',
                                    '{{$unPurchaseOrder -> purchaseOrderCredentials -> requested_by}}',
                                    '{{$unPurchaseOrder -> purchaseOrderCredentials -> prepared_by}}',
                                    '{{$unPurchaseOrder -> purchaseOrderCredentials -> approved_by}}',
                                    '{{$unPurchaseOrder -> systemStatus -> status}}',
                                    [
                                        @foreach($unPurchaseOrder -> purchaseOrderItems as $item)
                                        '{{$item -> item_name}}',
                                        @endforeach
                                    ]
                                )"><i class="fa-solid fa-eye"></i></button></div>
    
                            <div class="bg-red-500 p-1 rounded-md shadow-md">
                                <form method="POST" action="{{route('admindeleteunpurchase', ['id' => $unPurchaseOrder -> id])}}">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this unpurchase order?')">
                                    <i class="fa-solid fa-trash"></i>
                                </form>
                                </button>
                            </div>
                            </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4 font-bold">
            {{$unPurchaseOrders -> links()}}
        </div>
</div>

<div id="modal_details" class="hidden fixed top-0 left-0 w-full h-full flex items-start justify-center pt-40 bg-gray-900 bg-opacity-80">
    <div class="bg-white rounded-lg p-8">
        
        <h2 class="font-bold text-xl mb-2 text-center bg-gray-900 text-gray-200">Purchase Order Details</h2>
        <br>
        <div class="flex flex-row gap-12">
        <div>
        <p class="font-bold">Supplier: <span id="supplier" class="text-green-600"></span></p>
        <p class="font-bold">Requested By: <span id="requested_by" class="text-green-600"></span></p>
        <p class="font-bold">Approved By: <span id="approved_by" class="text-green-600"></span></p>
        </div>
        <div>
        <p class="font-bold">PO Number: <span id="po_number" class="text-green-600"></span></p>
        <p class="font-bold">Prepared By:<span id="prepared_by" class="text-green-600"></span></p>
        <p class="font-bold">Status: <span id="status" class="capitalize text-yellow-600"></span></p>
        </div>
        </div>
        <br><hr><br>
        <p class="font-bold">List of Items:</p>
        <ul id="item_list" class="font-bold text-blue-600"></ul>

        <button id="close_modal" class="bg-red-400 hover:bg-red-600 text-white font-bold p-1 px-1 rounded-md text-sm ml-96">Close</button>
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