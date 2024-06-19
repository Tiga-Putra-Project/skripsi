@extends('layouts.main')
@section('main')
<script>
    const date = new Date();

    let day = date.getDate() + 1;
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
                                <div class="form-group" id="pelabuhan_asal-container">
                                    <label for="pelabuhan_asal_id" class="form-label text-white">Pelabuhan Asal</label>
                                    <select class="form-control bg-white border-0" id="pelabuhan_asal_id" name="pelabuhan_asal_id" data-placeholder="Pelabuhan asal">
                                        <option></option>
                                        @foreach ($pelabuhans as $pelabuhan)
                                            <option value="{{$pelabuhan->id}}">{{$pelabuhan->nama_provinsi}}, {{$pelabuhan->nama_kota}} | {{$pelabuhan->kode_pelabuhan}} - {{$pelabuhan->tempat_pelabuhan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="pelabuhan_tujuan-container">
                                    <label for="pelabuhan_tujuan_id" class="form-label text-white">Pelabuhan Tujuan</label>
                                    <select class="form-control bg-white border-0" id="pelabuhan_tujuan_id" name="pelabuhan_tujuan_id" data-placeholder="Pelabuhan tujuan">
                                        <option></option>
                                        @foreach ($pelabuhans as $pelabuhan)
                                            <option value="{{$pelabuhan->id}}">{{$pelabuhan->nama_provinsi}}, {{$pelabuhan->nama_kota}} | {{$pelabuhan->kode_pelabuhan}} - {{$pelabuhan->tempat_pelabuhan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating date">
                                    <input type="text" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Tanggal Keberangkatan" data-date-days-of-week-disabled="" required>
                                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipe_tiket" class="form-label text-white">Tipe Tiket</label>
                                    <select class="form-control bg-white border-0" id="tipe_tiket" name="tipe_tiket" data-placeholder="Tipe Tiket">
                                        <option></option>
                                        <option value="1">Pejalan Kaki</option>
                                        <option value="2">Sepeda</option>
                                        <option value="3">Sepeda Motor</option>
                                        <option value="3">Mobil</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="penumpang" class="form-label text-white">Penumpang</label>
                                    <input type="number" min="1" class="form-control bg-white border-0" id="penumpang" placeholder="Jumlah Penumpang">
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

@section('js')
    <script>
        $('#tanggal_keberangkatan').datepicker({
            todayBtn: true,
            startDate: currentDate,
            language: 'id',
            zIndexOffset: 999999
        });

        $('#tipe_tiket').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#pelabuhan_asal-container")
        });

        $('#pelabuhan_asal_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#pelabuhan_asal-container"),
            templateResult: formatState
        });

        $('#pelabuhan_asal_id').on('change', function() {
            setTimeout(function () {
                var elements = $('#select2-pelabuhan_asal_id-container');
                var text = elements[0].innerText.split('|');
                elements[0].innerText = `${text[0]} (${text[1]})`;
            }, 0);
        });

        $('#pelabuhan_tujuan_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#pelabuhan_tujuan-container"),
            templateResult: formatState
        });

        $('#pelabuhan_tujuan_id').on('change', function() {
            setTimeout(function () {
                var elements = $('#select2-pelabuhan_tujuan_id-container');
                var text = elements[0].innerText.split('|');
                elements[0].innerText = `${text[0]} (${text[1]})`;
            }, 0);
        });

        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var text = state.text.split('|');
            var $state = $(
                `<div class="row">
                    <div class="col-md-12" style="font-weight: bold">
                        ${text[0]}
                    </div>
                    <div class="col-md-12" style="font-size: 12px">
                        ${text[1]}
                    </div>
                </div>`
            );
            return $state;
        };
    </script>
@endsection
