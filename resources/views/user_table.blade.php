@extends('layout')

@section('content')
    <body>
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
                            <h3 class="mb-0">Tabel User</h3>
                        </div>
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 400px" >
                            <table class="table table-hover align-items-center table-flush">
                                <thead class="thead-new">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $user as $s )
                                    <tr>
                                    <td>
                                        {{ $s->user_id }}
                                    </td>
                                    <td>
                                        {{ $s->username }}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $s->created_at }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                onclick="loadModal(this)" target="/update">
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
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js?v=1.0.0"></script>
    </body>
@endsection