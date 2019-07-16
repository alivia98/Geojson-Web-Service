@extends('layout')

@section('content')
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
        <div class="container-fluid mt--7" style="margin-top: 15px">
            <div class="row">
                <div class="col" style="background-color: whitesmoke; border-radius: 15px ">
                    <div class="element-left" style="padding-top: 30px; padding-left: 30px; margin-bottom: 0px">
                        <h1>Peta Lokasi Tanah Longsor</h1>
                    </div>
                    <div class="element-right">
                        <div class="form-group select-type-view" style="padding-top: 0px">
                            <label for="tipe-view"></label>
                            <select class="form-control" id="tipe-view">
                                <option value="1" selected>Titik Lokasi</option>
                                <option value="2">Wilayah</option>
                            </select>
                        </div>
                    </div>
                    <div id="map-bjn" class="card shadow border-0">
                        <div id="map-canvas" class="map-canvas" data-lat="40.748817" data-lng="-73.985428" style="height: 600px;"></div>
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

        <script src="{{ asset('../assets/js/main.js') }}"></script>
@endsection