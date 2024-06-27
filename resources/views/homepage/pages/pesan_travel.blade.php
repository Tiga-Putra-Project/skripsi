@extends('layouts.main')
@section('main')

    {{-- Pesan Tiket Kapal --}}
    <div class="container-fluid booking py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h5 class="section-booking-title pe-3">Booking</h5>
                    <h1 class="text-white mb-4">Travel Kendaraan</h1>
                    <br>
                    <h6 class="text-white">1. Masukkan Asal Alamat Penjemputan Anda</h6>
                    <h6 class="text-white">2. Masukkan Alamat Tujuan</h6>
                    <h6 class="text-white">3. Masukkan Tanggal Keberangkatan</h6>
                    <h6 class="text-white">4. Masukkan Jumlah Penumpang</h6>
                    <h6 class="text-white">6. Klik Cari Sekarang!</h6>
                </div>
                <div class="col-lg-6">
                    <h1 class="text-white mb-3">Cari Travel Kendaraan</h1>
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
                                    <label for="datetime">Tanggal & Jam Keberangkatan</label>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                <button class="btn btn-primary text-white w-100 py-3" type="submit">Cari Sekarang!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
