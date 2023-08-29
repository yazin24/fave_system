@extends('admin.admin_home')

@section('admin-body')
    <div class="w-full">
        <h2 class="font-bold md:text-xl mb-4 ml-1">Stock Monitoring</h2>

        <div class="flex flex-row">
            <div class="ct-chart bg-gray-200 font-bold pt-2 w-full md:w-1/2 h-[300px] md:h-[500px]" id="bar-chart"></div>
        </div>
    </div>

    <script>
        var stocksData = {!! json_encode($salesData) !!}; // Pass stocks data from your controller

        var formattedDate = stocksData.map(item => item.formatted_date);
        var amount = stocksData.map(item => item.total_amount);

        var data = {
            labels: formattedDate,
            series: [amount],
        };

        var options = {
           
            height: 500
        };

        new Chartist.Bar('#bar-chart', data);

    </script>
@endsection