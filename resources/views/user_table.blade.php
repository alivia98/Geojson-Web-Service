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
        <div class="header pt-5 pt-md-8" style="padding-bottom: 4rem; background-color: #d31e40">
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
                            <h1 class="mb-0">Tabel User</h1>
                            @if(Auth::user()->role_id == '1')
                            <button id="btn-add-user" type="button" class="btn btn-success" data-dismiss="modal" style="margin-top: 15px" data-toggle="modal" data-target="#myModal" target="/tambah">Tambah data</button>
                            @endif
                        </div>
                        <div class="table-responsive" style="overflow-y: scroll; max-height: 400px" >
                            <table class="table table-hover align-items-center table-flush">
                                <thead class="thead-new">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Tanggal Buat</th>
                                    @if(Auth::user()->role_id == '1')
                                    <th scope="col">Action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <?php $indeks = 1; ?>
                                @foreach( $user as $s )
                                    <tr>
                                    <td>
                                        {{ $indeks }}
                                    </td>
                                    <td>
                                        {{ $s->username }}
                                    </td>
                                    <td>
                                        {{ $s->role_name }}
                                    </td>
                                    <td>
                                        {{ $s->created_at }}
                                    </td>
                                    @if(Auth::user()->role_id == '1')
                                    <td>
                                        <button type="button" class="btn btn-primary edit-user" data-id="{{ $s->user_id }}"
                                                data-toggle="modal" data-target="#myModal" target="/update">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger hapus-user" data-toggle="modal">
                                            <a class="fas fa-trash-alt" href="/user_table/hapus/{{ $s->user_id }}"></a>
                                        </button>
                                    </td>
                                    @endif
                                </tr>
                                <?php $indeks++; ?>
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
                        <h3 class="modal-title">Edit User</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- body modal -->
                    <div class="modal-body">
                        <form id="form-user">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input class="form-control" id="username" type="text" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select class="form-control select-role" id="role_id" name="role_id" required>
                                            <option value="0" disable="true" selected="true">== Pilih Role ==</option>
                                            @foreach( $role as $r )
                                                <option value="{{ $r->role_id }}"> {{ $r->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input class="form-control" id="password" type="password" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ulangi Password</label>
                                        <input class="form-control" type="password" name="">
                                    </div>
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
        role = <?php echo $role; ?>;
    </script>
    <script src="{{ asset('../assets/js/main.js') }}"></script>
    </body>
@endsection