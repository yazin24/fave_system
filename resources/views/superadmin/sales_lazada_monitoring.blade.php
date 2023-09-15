@extends('superadmin.superadmin_home')

@section('superadmin-body')


<div class="bg-white-900 text-gray-900 mt-2 font-bold">
    
                    <h2 class="font-bold text-blue-900">Lazada Sales Monitoring</h2>
    
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class="bg-gray-900 border-b-2 text-gray-300 w-96 h-6">
                    <th class="text-xs text-center w-1/5">ORDER NUMBER</th>
                    <th class="text-xs text-center w-1/5">FULL NAME</th>
                    <th class="text-xs text-center w-1/5">ADDRESS</th>
                    <th class="text-xs text-center w-1/5">NUMBER</th>
                    <th class="text-xs text-center w-1/5">ACTION</th>
                    
            </tr>
        </thead>
        <tbody>
           @foreach($allLazadaSales as $lazadaSale)
            <tr class="h-6">
                    <td class="border-b-2 text-xs text-center">{{$lazadaSale -> order_number}}</td>
                    <td class="border-b-2 text-xs text-center">{{$lazadaSale -> customers_name}}</td>
                    <td class="border-b-2 text-xs text-center text-[9px]">{{$lazadaSale -> customers_address}}</td>
                    <td class="border-b-2 text-xs text-center">{{$lazadaSale -> phone_number}}</td>
                    <td class="border-b-2 text-xs text-center hover:underline text-red-600 hover:font-bold"><div class="flex flex-row justify-center gap-2">
                        <div>
                            <a href="{{route('lazadaorderdetailstoedit', ['lazadaOrder' => $lazadaSale -> id])}}"><i class="fa-solid fa-pen-to-square text-teal-600 rounded-sm hover:text-teal-700"></i></a>
                        </div>
                       |
                        <div>  
                            {{-- <form method="POST" action="{{route('lazadaorderdelete', ['lazadaOrder' => $lazadaSale -> id])}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa-solid fa-trash text-red-600 rounded-sm  hover:text-red-700"></i></a></button>
                            </form>  --}}
                        </div>
                    </div>
                </td>
            </tr>
           @endforeach  
        </tbody>
    </table>
</div>
<div class="mt-1 ml-2">
    <x-shopee-pagination :paginator="$allLazadaSales" />
</div>
{{-- {{$agent -> created_at -> format('Y-m-d h:s:i A')}} --}}

@endsection