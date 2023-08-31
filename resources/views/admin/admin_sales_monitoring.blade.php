@extends('admin.admin_home')

@section('admin-body')
<div class="w-full">
    <h2 class="font-bold md:text-xl mb-2 ml-1">Sales Graph Monitoring</h2>
    
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