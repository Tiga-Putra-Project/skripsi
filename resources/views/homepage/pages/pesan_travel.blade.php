@extends('layouts.main')
@section('main')
    <script>
        const date = new Date();

        let day = date.getDate();
        let month = date.getMonth() + 1;
        month = month.toString().padStart(2, '0');
        let year = date.getFullYear();

        let currentDate = `${day}-${month}-${year}`
    </script>
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
                    <form id="transportasi_form">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <div class="form-group" id="alamat_jemput-container">
                                    <label class="form-label text-white" for="alamat_jemput">Alamat Penjemputan</label>
                                    <textarea class="form-control rounded-0 border-0" id="alamat_jemput" name="alamat_jemput" placeholder="Alamat Lengkap" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group" id="kota_jemput-container">
                                        <select class="form-control bg-white border-0" id="kota_jemput" name="kota_jemput" data-placeholder="Kota Penjemputan" required>
                                            <option></option>
                                            @foreach ($kotas as $kota)
                                                <option value="{{$kota->id}}">{{ $kota->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="alamat_tujuan-container">
                                    <label class="form-label text-white" for="alamat_tujuan">Alamat Tujuan</label>
                                    <textarea class="form-control rounded-0 border-0" id="alamat_tujuan" name="alamat_tujuan" placeholder="Alamat Lengkap" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group date">
                                    <label class="form-label text-white" for="tanggal_keberangkatan">Tanggal & Jam Keberangkatan</label>
                                    <input type="text" class="form-control rounded-0 border-0" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Tanggal Keberangkatan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label class="form-label text-white">&nbsp;</label>
                                    <input type="time" class="form-control rounded-0 border-0" id="jam_keberangkatan" name="jam_keberangkatan" placeholder="Jam Keberangkatan" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label text-white" for="jumlah_penumpang">Jumlah Penumpang</label>
                                    <input type="number" class="form-control bg-white border-0 rounded-0" id="jumlah_penumpang" min="0" placeholder="Jumlah Penumpang" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary text-white w-100 py-3" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="btn-cari" disabled>Cari Sekarang!</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hasil Pencarian Travel</h1>
                            </div>
                            <div class="modal-body">
                                <div id="hasil-pencarian-container">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="$('#hasil-pencarian-container').html('')" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#kota_jemput').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#kota_jemput-container'),
            });
        });

        $('#tanggal_keberangkatan').datepicker({
            todayBtn: true,
            startDate: currentDate,
            language: 'id',
            zIndexOffset: 999999,
        });

        $('#transportasi_form').on('change', function(){
            var form = $(this);
            if (form[0].checkValidity()) {
                $('#btn-cari').prop('disabled', false);
            } else {
                $('#btn-cari').prop('disabled', true);
            }
        });

        $('#btn-cari').click(function () {
            $('#spinner').addClass('show');
            $.ajax({
                url: "{{ route('api.transportasi', [], false) }}",
                type: "GET",
                data: {
                    'kota_id': $('#kota_jemput').val(),
                    'jumlah_penumpang': $('#jumlah_penumpang').val()
                },
                success: function (data) {
                    $('#spinner').removeClass('show');
                    if(data.length > 0){
                        data.forEach(function(value, index){
                            $('#hasil-pencarian-container').append(`
                                    <div class="tiket mb-2 mt-2 d-flex align-items-center justify-content-between" >
                                        <div>
                                            <h4 class="mb-0">${value.nama_lengkap}</h4>
                                            <p class="mb-0">Kendaraan: ${value.nama_kendaraan}</p>
                                            <p class="mb-0">Plat: ${value.plat_kendaraan}</p>
                                        </div>
                                        <div id="container-btn-pesan-${value.id_driver}">
                                            <div class="btn-pesan btn btn-primary text-white w-100 py-3" onClick="getTicket(this)" data-id="${value.id_driver}" id="btn-pesan-${value.id_driver}">Pesan Sekarang</div>
                                        </div>
                                    </div>
                                    <hr>`);
                        });
                    } else {
                        $('#hasil-pencarian-container').html('<p class="text-center">Tidak ditemukan travel yang sesuai.</p>');
                    }
                }
            });
        });

        function getTicket(e){
            var id = $(e).data('id');
            var jumlah_penumpang = $('#jumlah_penumpang').val();
            var alamat_jemput = $('#alamat_jemput').val();
            var alamat_tujuan = $('#alamat_tujuan').val();
            var tanggal_keberangkatan = $('#tanggal_keberangkatan').val();
            var jam_keberangkatan = $('#jam_keberangkatan').val();
            var form = $('<form action="{{route("transportasi.transaksi", [], false)}}" method="post">' +
                           '<input type="hidden" name="id_driver" value="' + id  + '" />' +
                           '<input type="hidden" name="jumlah_penumpang" value="' + jumlah_penumpang  + '" />' +
                           '<input type="hidden" name="alamat_jemput" value="' + alamat_jemput  + '" />' +
                           '<input type="hidden" name="alamat_tujuan" value="' + alamat_tujuan  + '" />' +
                           '<input type="hidden" name="tanggal_keberangkatan" value="' + tanggal_keberangkatan  + '" />' +
                           '<input type="hidden" name="jam_keberangkatan" value="' + jam_keberangkatan  + '" />' +
                           '<input type="hidden" name="_token" value="{{ csrf_token() }}" />'+
                        '</form>');
            $('body').append(form);
            form.submit();
        }
    </script>
@endsection
