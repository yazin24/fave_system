@extends('admin.admin_home')

@section('admin-body')
    <div class="w-full">
        <h2 class="font-bold md:text-xl mb-4 ml-1">Stock Monitoring</h2>

        <div class="flex flex-row mb-2">
            <div class="ct-chart bg-gray-200 font-bold pt-2 w-[1200px] md:w-1/2 md:h-[150px]" id="shopee-chart"></div>
        </div>
        <div class="flex flex-row mb-2">
            <div class="ct-chart bg-gray-200 font-bold pt-2 w-[1200px] md:w-1/2 md:h-[150px]" id="lazada-chart"></div>
        </div>
        <div class="flex flex-row mb-2">
            <div class="ct-chart bg-gray-200 font-bold pt-2 w-[1200px] md:w-1/2 md:h-[150px]" id="bar-chart"></div>
        </div>
    </div>

    <script>
        var fixedValue = 50000;

        var shopeeData = {!! json_encode($shopeeData) !!}; // Pass stocks data from your controller
        var formattedDate = shopeeData.map(item => item.formatted_date);
        var amount = shopeeData.map(item => item.total_amount);
        var scaledAmount = amount.map(value => (value * 100) / fixedValue);
        var shopeeSalesdata = {
            labels: formattedDate,
            series: [scaledAmount],
        };
        var options = {
            height: 300
        };

        var lazadaData = {!! json_encode($lazadaData) !!}; // Pass stocks data from your controller
        var formattedDate = lazadaData.map(item => item.formatted_date);
        var amount = lazadaData.map(item => item.total_amount);
        var lazadaSalesdata = {
            labels: formattedDate,
            series: [amount],
        };
        var options = {
            height: 300
        };


        new Chartist.Bar('#shopee-chart', shopeeSalesdata);
        new Chartist.Bar('#lazada-chart', lazadaSalesdata);
        new Chartist.Bar('#shopee-chart', data);

    </script>
@endsection