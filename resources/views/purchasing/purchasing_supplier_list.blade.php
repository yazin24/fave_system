@extends('purchasing.purchasing_home')
@section('purchasing-body')

<div class="w-full mx-auto">
    {{-- <form class="bg-indigo shadow-md rounded px-8 pt-6 pb-8 mb-4"> --}}

        <h2 class="font-bold text-xl mb-4 ml-1">Supplier List</h2>
            <div class="mt-8">
                <form method="POST" action="{{route('showsupplieritems')}}">
                @csrf
                    <div>
                        
                        <select name="selected_id" class="text-sm">
                            <option value="" disabled selected>Select</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{$supplier -> id}}" for="select">{{$supplier -> supplier_name}}</option>
                            @endforeach
                        </select>
                            <div class="mt-1">
                                <button type="submit" class="bg-green-400 hover:bg-blue-600 rounded-md p-1 text-xs text-gray-200">See Details</button>
                            </div>
                    </div>
                </form>
            </div>

            <div class="md:mx-44 mt-8">
                @if(isset($supplierItems))
                <table class="bg-gray-300 shadow-lg w-full">
                
                    @foreach($supplierItems -> groupBy('suppliers.supplier_name') as $supplierName => $items)
                    <thead>
                        <tr class="bg-gray-900 border-b-2 text-gray-300 w-full h-10">
                            <th>{{$supplierName}}</th>
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
    {{-- </form> --}}
</div>

@endsection