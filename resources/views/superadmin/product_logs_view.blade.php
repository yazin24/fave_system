@extends('superadmin.superadmin_home')

@section('superadmin-body')


   <h3 class="font-bold">Product: {{$allProduct -> full_name}}<a class="ml-2 border-b-2 text-xs text-center w-1/6 text-red-500 hover:text-red-600 hover:font-bold hover:underline" href="{{route('addstockform', ['allProduct' => $allProduct])}}">Update</a></h3>

<div class="">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class=" bg-gray-900 border-b-2 text-gray-300 w-full">
                <th class="text-xs md:text-sm text-center w-1/4">DATE</th>
                <th class="text-xs md:text-sm text-center w-1/4">ACTION</th>
                <th class="text-xs md:text-sm text-center w-1/4">QUANTITY</th>
                {{-- <th class="text-xs md:text-sm text-center w-1/4">ACTION</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($productLogs as $log)
                <tr class="h-6 md:h-8">
                    <td class="border-b-2 text-xs text-center">{{$log['date'] -> format('Y-m-d')}}</td>
                    <td class="border-b-2 text-xs text-center">{{$log['action']}}</td>
                    <td class="border-b-2 text-xs text-center">{{$log['quantity']}}</td>
                    {{-- <td class="border-b-2 text-xs text-center w-1/6 text-red-500 hover:text-red-600 hover:font-bold hover:underline"><a href="{{route('updatestock', ['allProduct' => $allProduct])}}">Update</a></td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection