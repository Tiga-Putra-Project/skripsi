@extends('layouts.main')
@section('main')
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="mx-auto text-left">
                    <h3 class="mb-3">Detail Pemesan Tiket</h3>
                    <h5>Detail kontak ini akan digunakan untuk bukti transaksi</h5>
                </div>
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card border-1 shadow-sm rounded">
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="title" id="tuan" value="Tuan" checked>
                                                <label class="form-check-label" for="tuan">Tuan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="title" id="nyonya" value="Nyonya">
                                                <label class="form-check-label" for="nyonya">Nyonya</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
