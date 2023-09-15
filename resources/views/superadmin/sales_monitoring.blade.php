@extends('superadmin.superadmin_home')

@section('superadmin-body')

<div class="w-full">
    <div class="flex flex-row">
        <div>
            <h2 class="font-bold md:text-lg mb-1 ml-1">Sales Monitoring</h2>
        </div>
        <div class="ml-4">
            <button class="bg-teal-600 hover:bg-teal-700 px-1 py0.3 rounded-sm font-bold text-gray-200 text-sm ml-2"><a href="{{route('salesmanualmonitoring')}}">Manual</a></button>
            <button class="bg-orange-600 hover:bg-orange-700 px-1 py-0.3 rounded-sm font-bold text-gray-200 text-sm ml-2"><a href="{{route('salesshopeemonitoring')}}">Shopee</a></button>
            <button class="bg-blue-800 hover:bg-blue-900 px-1 py0.3 rounded-sm font-bold text-gray-200 text-sm ml-2"><a href="{{route('saleslazadamonitoring')}}">Lazada</a></button>
            <button class="bg-gray-900 hover:bg-gray-800 px-1 py0.3 rounded-sm font-bold text-gray-200 text-sm ml-2"><a>Tiktok</a></button>
            <button class="bg-red-600 hover:bg-red-700 px-1 py0.3 rounded-sm font-bold text-gray-200 text-sm ml-2"><a>Carousel</a></button>
        </div>
        
        <div class="flex justify-end ml-2">
            <x-shopee-pagination :paginator="$shopeeSalesData"/>
        </div>
    </div>
        <div class="flex flex-col lg:flex-row gap-2">

            <div class="w-full">

            <div class="mb-2">
                <canvas id="shopeeChart" class="bg-gray-200" ></canvas>
            </div>

            <div class="">
                <canvas id="manualChart" class="bg-gray-200"</canvas>
            </div>

            </div>

            <div class="w-full">

            <div class="mb-2">
            <canvas id="lazadaChart" class="bg-gray-200" ></canvas>
            </div>

            <div>
            <canvas id="donutChart" class="bg-gray-200"</canvas>
            </div>

            </div>
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var commonOptions = {
            scales: {
                y: {
                    beginAtZero: false
                }
            },
        };

        var barChartOptions = {
            ...commonOptions,
            scales: {
                y: {
                    ...commonOptions.scales.y,
                    ticks: {
                        callback: function (value) {
                            return '₱' + value;
                        }
                    }
                }
            }
        };

        var shopeeCtx = document.getElementById('shopeeChart').getContext('2d');
        var shopeeChart = new Chart(shopeeCtx, {
            type: 'bar',
            data: {
                labels: @json($shopeeDates),
                datasets: [{
                    label: 'Shopee Total Sales',
                    data: @json($shopeeAmounts),
                    backgroundColor: '#ff6600',
                    borderWidth: 1
                }]
            },
            options: barChartOptions
        });

        var lazadaCtx = document.getElementById('lazadaChart').getContext('2d');
        var lazadaChart = new Chart(lazadaCtx, {
            type: 'bar',
            data: {
                labels: @json($lazadaDates),
                datasets: [{
                    label: 'Lazada Total Sales',
                    data: @json($lazadaAmounts),
                    backgroundColor: '#4600ba',
                    borderWidth: 1
                }]
            },
            options: barChartOptions
        });

        var manualCtx = document.getElementById('manualChart').getContext('2d');
        var manualChart = new Chart(manualCtx, {
            type: 'bar',
            data: {
                labels: @json($manualDates),
                datasets: [{
                    label: 'Manual Total Sales',
                    data: @json($manualAmounts),
                    backgroundColor: '#9700ff',
                    borderWidth: 1
                }]
            },
            options: barChartOptions
        });

        var donutCtx = document.getElementById('donutChart').getContext('2d');
        var donutChart = new Chart(donutCtx, {
            type: 'line',
            data: {
                labels: @json($bestSellingLabels),
                datasets: [
                    {
                        label: 'Shopee',
                        data: @json($skuShopeeQuantities -> map -> total_quantity),
                        borderColor: '#ff6600',
                        fill: false
                    },
                    {
                        label: 'Lazada',
                        data: @json($skuLazadaQuantities -> map -> total_quantity),
                        borderColor: '#4600ba',
                        fill: false
                    },
                    {
                        label: 'Manual',
                        data: @json($skuManualQuantities -> map -> total_quantity),
                        borderColor: '#9700ff',
                        fill: false
                    }
            ]
            },
            options: commonOptions
        });
    });

    
</script>

@endsection