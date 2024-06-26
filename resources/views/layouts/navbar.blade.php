
    <!-- Navbar & Hero Start -->
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ route('homepage.landing', [], false) }}" class="navbar-brand p-0">
            <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Tiga Putra Travel</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('homepage.landing', [], false) }}" class="nav-item nav-link">Home</a>
                <a href="#about"  class="nav-item nav-link">About</a>
                <a href="#service" class="nav-item nav-link">Services</a>
                <a href="#contact" class="nav-item nav-link">Contact</a>
            </div>
            <a href="{{route('pesan-tiket.index')}}" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>

        </div>
    </nav>
