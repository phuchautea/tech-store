@extends('admin.main')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <b>Thống kê</b>
                    </h3>
                </div>
                <div class="card-body">
                    <script src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(function() { 
                            drawChart(<?php echo json_encode($salesStatistics); ?>, 'Doanh thu theo tháng (VND)', 'salesStatisticsChart', 'LineChart');
                            drawChart(<?php echo json_encode($soldQuantityStatistics); ?>, 'Sản phẩm bán chạy', 'soldQuantityStatisticsChart', 'ColumnChart');
                            drawChart(<?php echo json_encode($paymentMethodStatistics); ?>, 'Phương thức thanh toán', 'paymentMethodStatisticsChart', 'PieChart');
                        });

                        function drawChart(chartData, title, chartId, typeChart = 'ColumnChart') {
                            var data = google.visualization.arrayToDataTable(chartData);

                            var options = {
                                title: title,
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization[typeChart](document.getElementById(chartId));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="salesStatisticsChart"></div>
                    <div id="soldQuantityStatisticsChart"></div>
                    <div id="paymentMethodStatisticsChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection