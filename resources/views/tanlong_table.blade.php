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
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <!-- Table -->
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0" >
                            <h3 class="mb-0">Tabel Riwayat Tanah Longsor</h3>
                            <button id="btn-add" type="button" class="btn btn-success" data-dismiss="modal" style="margin-top: 15px" data-toggle="modal" data-target="#myModal" target="/tambah">Tambah data</button>
                        </div>
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 400px">
                            <table class="table table-hover align-items-center table-flush" >
                                <thead class="thead-new" >
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Desa</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody >
                                @foreach( $tanlong as $t )
                                    <tr>
                                        <td>
                                            {{ $t->tanlong_id }}
                                        </td>
                                        <td>
                                            {{ $t->tahun }}
                                        </td>
                                        <td>
                                            {{ $t->nama_desa }}
                                        </td>
                                        <td>
                                            {{ $t->kecamatan }}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary edit-modal" data-id="{{ $t->tanlong_id }}"
                                                    data-toggle="modal" data-target="#myModal" target="/update">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger" data-toggle="modal">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- konten modal-->
                <div class="modal-content">
                    <!-- heading modal -->
                    <div class="modal-header">
                        <h3 class="modal-title">Edit riwayat tanah longsor</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- body modal -->
                    <div class="modal-body">
                        <form id="form-tanlong" action="/tanlong_table/store " method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Tanggal</label>
                                        <input class="form-control" type="date" name="tanggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kecamatan</label>
                                        <select class="form-control select-kecamatan" id="kecamatan" name="kecamatan">
                                            <option value="0" disable="true" selected="true">=== Pilih Kecamatan ===</option>
                                            @foreach( $kecamatan as $k )
                                                <option value="{{ $k->kecamatan_id }}"> {{ $k->kecamatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Desa</label>
                                        <select class="form-control" id="desa" name="desa">
                                                <option value="0" disable="true" selected="true"></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Korban</label>
                                        <input class="form-control" type="number" name="korban">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kerusakan</label>
                                        <textarea class="form-control" id="" rows="3" name="kerusakan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kerugian</label>
                                        <input class="form-control" type="number" name="kerugian">
                                    </div>
                                </div>
                                <div class="col" style="margin-left: 30px">
                                    <div id="draw-map" class="map-canvas"  style="width: 600px; height: 300px; "></div>
                                    <div class="row lat-lang-modal" style="margin-top: 15px">
                                        <div class="col">
                                            <label for="">Longitude</label>
                                            <input  name="longitude" type="text" class="form-control" placeholder="Longitude" value="">
                                        </div>
                                        <div class="col">
                                            <label for="">Latitude</label>
                                            <input  name="latitude" type="text" class="form-control" placeholder="Latitude">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success" style="margin-top: 15px; alignment: right" id="draw-point" onclick="updateMarkerByInputs()">Pilih lokasi</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                    <!-- footer modal -->
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
        <script>
            data_kecamatan = <?php echo $kecamatan; ?>;
            localStorage.setItem("data_kecamatan", data_kecamatan);

            var mapCenter = [-7.2270701, 111.5144818];
            var map = L.map('draw-map', {center : mapCenter, zoom : 11});

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets-satellite',
                accessToken: 'pk.eyJ1IjoiYWxpdmlhcmFoOTgiLCJhIjoiY2p2bnZjMjk3MDRlbDQ4cGk5MTEyeXlnaSJ9.XbTgr6-iLZAygZRJ9dyvfg'
            }).addTo(map);

            var marker = L.marker(mapCenter).addTo(map);
            var updateMarker = function(lat, lng) {
                marker
                    .setLatLng([lat, lng])
                    .bindPopup("Your location :  " + marker.getLatLng().toString())
                    .openPopup();
                return false;
            };

            map.on('click', function(e) {
                $('.lat-lang-modal input[name="latitude"]').val(e.latlng.lat);
                $('.lat-lang-modal input[name="longitude"]').val(e.latlng.lng);
                updateMarker(e.latlng.lat, e.latlng.lng);
            });

            var updateMarkerByInputs = function() {
                return updateMarker( $('.lat-lang-modal input[name="latitude"]').val() , $('.lat-lang-modal input[name="longitude"]').val());
            }

            $('#kecamatan').on('change', function(){
                var kecamatan_id = $(this).val();
                $.get('/api/get-desa-list?kecamatan_id=' + kecamatan_id,function(data) {
                    console.log(data);
                    $('#desa').empty();
                    $('#desa').append('<option value="0" disable="true" selected="true">=== Pilih desa ===</option>');

                    $.each(data, function(index, desaObj){
                        $('#desa').append('<option value="'+ desaObj.id +'">'+ desaObj.nama_desa +'</option>');
                    })
                });
            });
        </script>
        <script src="{{ asset('../assets/js/main.js') }}"></script>

@endsection