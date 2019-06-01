@extends('layout')

@section('content')
    <body class="bg-default">
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center">
                    <h1 class="text-white">Welcome!</h1>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <small>Sign Up Please...</small>
                            </div>
                            <form role="form" method="post" action=" {{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                        </div>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username') }}" type="text" required>

                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                        </div>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="Email" value="{{ old('email') }}" type="email" required>

                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="Password" type="password" required>

                                        @if($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" placeholder="Password Confirmation" type="password">

                                        @if($errors->has('password_confirmation'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password_conformation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">Create account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('../assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('../assets/js/argon.js?v=1.0.0') }}"></script>
    </body>
@endsection