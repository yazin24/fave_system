@extends('admin.admin_home')

@section('admin-body')


<h2 class="font-bold md:text-xl mt-2">Product Logs</h2>

<h3 class="font-bold">Product: {{$allProduct -> full_name}}</h3>

<div class="">
    <table class="bg-gray-300 shadow-lg w-full">
        <thead>
            <tr class=" bg-gray-900 border-b-2 text-gray-300 w-full">
                <th class="text-xs md:text-sm text-center w-1/4">DATE</th>
                <th class="text-xs md:text-sm text-center w-1/4">ACTION</th>
                <th class="text-xs md:text-sm text-center w-1/4">QUANTITY</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($productLogs as $log)
                <tr class="h-6 md:h-8">
                    <td class="border-b-2 text-xs text-center">{{$log['date'] -> format('Y-m-d')}}</td>
                    <td class="border-b-2 text-xs text-center">{{$log['action']}}</td>
                    <td class="border-b-2 text-xs text-center">{{abs($log['quantity'])}}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection