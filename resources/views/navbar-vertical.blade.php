<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" style="width: 210px; height: 200px" href="../index.html">
            <img src="{{ asset('../assets/img/brand/logo1.png') }} " class="navbar-brand-logo" style=" max-width:100%; max-height:200px; margin-top: 10px" alt="...">
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/home">
                        <i class="ni ni-tv-2 text-primary"></i> Dashboard
                    </a>
                </li>
                @if(Auth::user()->role_id == '1')
                <li class="nav-item">
                    <a class="nav-link" href="/user_table">
                        <i class="ni ni-badge text-red"></i> User
                    </a>
                </li>
                @endif
                @if(Auth::user()->role_id == '2')
                    <li class="nav-item">
                        <a class="nav-link" href="/user_table">
                            <i class="ni ni-badge text-red"></i> User
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/tanlong_table">
                        <i class="ni ni-bullet-list-67 text-red"></i> Tanah Longsor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/graph">
                        <i class="ni ni-chart-bar-32 text-info"></i> Grafik
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>