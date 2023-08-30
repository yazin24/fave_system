@extends('admin.admin_home')

@section('admin-body')
    <div class="w-full">
        <h2 class="font-bold md:text-xl mb-4 ml-1">Sales Graph Monitoring</h2>

        <div class="flex flex-col md:flex-row gap-2">
            <canvas id="shopeeChart" class="bg-gray-200" width="200" height="400"></canvas>

        <canvas id="lazadaChart" class="bg-gray-200" width="200" height="400"></canvas>
        </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('shopeeChart').getContext('2d');
        
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($shopeeDates),
                datasets: [{
                    label: 'Shopee Total Sales',
                    data: @json($shopeeAmounts),
                    backgroundColor: 'rgb(255,123,0, 0.90)',
                    borderColor: 'rgb(255,0,0.74)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('lazadaChart').getContext('2d');
        
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($lazadaDates),
                datasets: [{
                    label: 'Lazada Total Sales',
                    data: @json($lazadaAmounts),
                    backgroundColor: 'rgb(70,0,186, 1)',
                    borderColor: 'rgb(70,154,255,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    </script>
@endsection