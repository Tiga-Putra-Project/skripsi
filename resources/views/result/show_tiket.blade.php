@extends('layouts.main')
@section('main')
    {{-- Tampilkan Tiket Kapal --}}
    <div class="container-fluid show py-5">
        <div class="container py-5">
            <div class="mx-auto text-left mb-5">
                <br>
                <h1 class="text-white mb-4">Detail Pemesan</h1>
                <h5 class="text-white mb-0">Detail Kontak pemesan ini digunakan untuk pengiriman Booking tiket</h5>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <form>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Tuan</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Nyonya</label>
                                  </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                      <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="form6Example1" class="form-control" />
                                        <label class="form-label" for="form6Example1">First name</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div data-mdb-input-init class="form-outline">
                                        <input type="text" id="form6Example2" class="form-control" />
                                        <label class="form-label" for="form6Example2">Last name</label>
                                      </div>
                                    </div>
                                  </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
