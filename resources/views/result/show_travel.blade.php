@extends('layouts.main')
@section('main')

    {{-- Tampilkan Tiket Kapal --}}
    <div class="container-fluid show py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <br>
                <br>
                <h1 class="mb-0">Pilihan Tiket Yang Tersedia</h1>
            </div>
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
    </div>

@endsection
