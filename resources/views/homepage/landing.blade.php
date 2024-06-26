@extends('layouts.main')
@section('main')

    <!-- Carousel Start -->
    <div class="carousel-header">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{('assets/images/bigship.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Ingin Mencari Tiket Kapal Beserta Trasportasinya?</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Tiga Putra Travel Solusinya</h1>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Cari Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{('assets/images/ferry.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Ingin Menggunakan Kapal Sebagai Transportasi?</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Cari Tiket kapal Anda Sekarang</h1>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Cari Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{('assets/images/Car.jpg') }}" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">Butuh Transportasi Untuk Ke Tempat Tujuan?</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4">Pesan Di Tiga Putra Travel</h1>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Cari Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon btn bg-primary" aria-hidden="false"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon btn bg-primary" aria-hidden="false"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- About Start -->
    <section id="about">
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5">
                    <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                        <img src="{{('/assets/images/ElaSepuh.jpeg') }}" class="img-fluid w-100 h-100" alt="">
                    </div>
                </div>
                <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                    <h1 class="mb-4">Welcome to <span class="text-primary">Tiga Putra Travel</span></h1>
                    <p class="mb-4"> Web Tiga Putra Travel merupakan platform pemesanan tiket kapal laut dan travel online. Kami berkomitmen untuk
                    memberikan pengalaman pemesanan tiket yang mudah, nyaman, dan aman bagi para pelanggan.</p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- About End -->
     <!-- Services Start -->
     <section id="service">
     <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Layanan Kami</h5>
                <h1 class="mb-0">Pesan Tiket Kapal & Travel</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-ship fa-3x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="text-center mb-4">Pesan Tiket Kapal</h5>
                                    <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                    </p>
                                    <br>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('pesan-tiket.index', [], false) }}">Cari Tiket Kapal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-car fa-4x text-primary"></i>
                                </div>
                                <div class="service-content">
                                    <h5 class="text-center mb-4">Pesan Travel Transportasi</h5>
                                    <p class="mb-0">Dolor sit amet consectetur adipisicing elit. Non alias eum, suscipit expedita corrupti officiis debitis possimus nam laudantium beatae quidem dolore consequuntur voluptate rem reiciendis, omnis sequi harum earum.
                                    </p>
                                    <br>
                                    <div class="col-12">
                                        <div class="text-center">
                                            <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="{{ route('pesan-travel.index', [], false) }}">Cari Travel Transportasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Services End -->
    <section id="contact">
    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Contact Person</h5>
                <h1 class="mb-0"></h1>
            </div>
            <div class="row text-center g-5 align-items-center">
                <div class="col-md-4">
                    <div class="contact-info p-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Address</h4>
                        <p class="mb-0">Jl. Kurnia Makmur Harapan Baru <br> Samarinda, Kalimantan Timur</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info p-4">
                        <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Mobile</h4>
                        <p class="mb-0">+62 823 5380 9624</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info p-4">
                        <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Email</h4>
                        <p class="mb-0">tigaputratravel@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact End -->
    </section>
@endsection
