@extends('admin.admin_home')

@section('admin-body')

<div class="w-full mx-auto">
    {{-- <form class="bg-indigo shadow-md rounded px-8 pt-6 pb-8 mb-4"> --}}

     <h2 class="font-bold text-xl mb-4 ml-1">Supplier List</h2>
        {{-- <div> --}}
            <div class="mt-8">
            <form method="POST" action="{{route('adminshowsuppliersitems')}}">
                @csrf
                <select name="selected_id" class="text-sm">
                    <option value="" disabled selected>Select</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{$supplier -> id}}" for="select">{{$supplier -> supplier_name}}</option>
                    @endforeach
                </select>
                <div class="mt-1">
                <button type="submit" class="bg-green-400 hover:bg-blue-600 rounded-md p-1 w-12  text-xs text-gray-200">Enter</button>
                </div>
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

        {{-- </div> --}}

    {{-- </form> --}}
</div>
@endsection