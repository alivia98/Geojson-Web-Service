<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="../index.html">
            <img src="{{ asset('../assets/img/brand/blue.png') }} " class="navbar-brand-img" alt="...">
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
                <li class="nav-item">
                    <a class="nav-link" href="/user_table">
                        <i class="ni ni-badge text-red"></i> User
                    </a>
                </li>
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