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
        var fixedValue = 50000; // Fixed value for the series

        var shopeeData = {!! json_encode($shopeeData) !!}; // Pass stocks data from your controller
        var formattedDate = shopeeData.map(item => item.formatted_date);
        var amount = shopeeData.map(item => item.total_amount);

        // Calculate the scaling factor based on the maximum amount
        var maxAmount = Math.max(...amount);
        var scalingFactor = fixedValue / maxAmount;

        // Scale the bar heights using the scaling factor
        var scaledAmount = amount.map(value => value * scalingFactor);

        var shopeeSalesData = {
            labels: formattedDate,
            series: [scaledAmount], // Use the scaled amounts for bar heights
        };
        var options = {
            height: 300
        };

        var lazadaData = {!! json_encode($lazadaData) !!}; // Pass stocks data from your controller
        var lazadaAmount = lazadaData.map(item => item.total_amount);

        // Calculate the scaling factor for Lazada chart
        var maxLazadaAmount = Math.max(...lazadaAmount);
        var scalingFactorLazada = fixedValue / maxLazadaAmount;

        // Scale the bar heights for Lazada chart
        var scaledLazadaAmount = lazadaAmount.map(value => value * scalingFactorLazada);

        var lazadaSalesData = {
            labels: formattedDate,
            series: [scaledLazadaAmount], // Use the scaled amounts for bar heights
        };

        new Chartist.Bar('#shopee-chart', shopeeSalesData, options);
        new Chartist.Bar('#lazada-chart', lazadaSalesData, options);
    </script>
@endsection