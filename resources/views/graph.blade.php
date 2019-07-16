@extends('layout')

@section('content')
    <!-- Sidenav -->
    @include('navbar-vertical')
    <!-- Main content -->
    <div class="main-content">
        <!-- Top navbar -->
    @include('navbar-top')
    <!-- Header -->
        <div class="header pt-5 pt-md-8" style="padding-bottom: 4rem; background-color: #d31e40">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h1 class="mb-0">Daerah Pemetaan Riwayat Tanah Longsor</h1>
                        </div>
                        <div id="map-mapping" class="card shadow border-0">
                            <div id="map-mapping" class="map-canvas" data-lat="40.748817" data-lng="-73.985428" style="height: 600px;"></div>
                        </div>
                        <div class="card-footer py-4">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h1 class="mb-0">Grafik</h1>
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
    <script>
        var dataArray;
        function getColor(d) {
            return  d > 9  ? '#E31A1C' :
                    d > 5  ? '#FC4E2A' :
                    d > 1   ? '#FD8D3C' :
                     '#FFEDA0';
        }

        function style(feature) {
            return {
                fillColor: getColor(feature.properties.jumlah),
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7
            };
        }

        function onEachFeature(feature, layer) {
            var popupContent =  "<div class='popup-body'> Desa : "+ feature.properties.nama_desa+"</div>"+
                "<div class='popup-body'> Jumlah Tanah Longsor : "+ feature.properties.jumlah+"</div>"
            layer.bindPopup(popupContent);
        }

        var mymap = L.map('map-mapping').setView([-7.2373719, 111.7938153], 11);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg'
        }).addTo(mymap);

         $.ajax({
             type : 'get',
             url : '/api/getMapDesaData',
             dataType: 'json',
             success : function(response){
                 console.log(response)

                 L.geoJSON(response, {
                     style : style,
                     onEachFeature: onEachFeature
                 }).addTo(mymap);
             }
         })

    </script>
    <script src="{{ asset('../assets/js/main.js') }}"></script>
@endsection