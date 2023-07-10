@extends('admin.admin_home')

@section('admin-body')

<h2 class="font-bold text-xl">Supplier List</h2>


<div>
    <div class="mt-4">
    <form method="POST" action="{{route('adminshowsuppliersitems')}}">
        @csrf
        <select name="selected_id" class="text-xs">
            <option value="" disabled selected>Select</option>
            @foreach($suppliers as $supplier)
            <option value="{{$supplier -> id}}" for="select">{{$supplier -> supplier_name}}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-400 hover:bg-blue-600 rounded-md p-1 ml-2 text-xs text-gray-200 shadow-md">Enter</button>
    </form>
    </div>
    <div class="mt-8">
        @if(isset($supplierItems))
        <table class="bg-gray-300 shadow-lg w-full">
            @foreach($supplierItems -> groupBy('suppliers.supplier_name') as $supplierName => $items)
            <thead>
                <tr class="bg-gray-900 border-b-2 text-gray-300 w-full h-10 text-md">
                    <th class="">
                        {{$supplierName}}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="h-24 p-4">
                        @foreach($items as $item)
                        {{$item -> item_name}}<br><hr><br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @endif
    </div>

</div>

@endsection