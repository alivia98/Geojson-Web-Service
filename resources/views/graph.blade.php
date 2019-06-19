@extends('layout')

@section('content')
    <!-- Sidenav -->
    @include('navbar-vertical')
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
    @include('navbar-top')
    <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">

                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h2 class="mb-0">Grafik</h2>
                        </div>
                        <canvas id="myChart" style="padding: 30px 30px 30px 30px"></canvas>
                        <div class="card-footer py-4">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
        $.ajax({
            type : 'get',
            url : '/api/getDisasterData',
            dataType: 'json',
            success : function(response){
                var tahun = [];
                var total = [];
                $.each(response, function (index, value) {
                    tahun.push(value.tahun);
                    total.push(value.total);
                })


                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: tahun,
                        datasets: [{
                            label: 'Kejadian tanah longsor ',
                            data: total,
                            backgroundColor:
                                'rgba(255, 99, 132, 0.2)'
                            ,
                            borderColor:
                                'rgba(255, 99, 132, 1)'
                            ,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        })
    </script>
@endsection