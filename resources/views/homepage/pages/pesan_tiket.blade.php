@extends('layouts.main')
@section('main')

    {{-- Pesan Tiket Kapal --}}
    <div class="container-fluid booking py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h5 class="section-booking-title pe-3">Booking</h5>
                    <h1 class="text-white mb-4">Booking Tiket Kapal</h1>
                    <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                    </p>
                </div>
                <div class="col-lg-6">
                    <h1 class="text-white mb-3">Cari Tiket yang Anda Inginkan</h1>
                    <p class="text-white mb-4">Get On Your First Adventure Trip With Travela. Get More Deal Offers Here.</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control bg-white border-0" id="name" placeholder="Your Name">
                                    <label for="name">Asal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-white border-0" id="email" placeholder="Your Email">
                                    <label for="email">Tujuan</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating date" id="date3" data-target-input="nearest">
                                    <input type="text" class="form-control bg-white border-0" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                    <label for="datetime">Date || Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select bg-white border-0" id="CategoriesSelect">
                                        <option value="1">Pejalan Kaki</option>
                                        <option value="2">Sepeda</option>
                                        <option value="3">Sepeda Motor</option>
                                        <option value="3">Mobil</option>
                                    </select>
                                    <label for="CategoriesSelect">Tipe Tiket</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control bg-white border-0" id="email" placeholder="Your Email">
                                    <label for="email">Penumpang</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control bg-white border-0" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                    <label for="message">Special Request</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary text-white w-100 py-3" type="submit">Cari Sekarang
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
