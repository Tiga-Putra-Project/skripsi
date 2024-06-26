@extends('layouts.main')
@section('css')
<style>

</style>

@endsection
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
                    <h1 class="text-white mb-4">Tiket Kapal</h1>
                    <br>
                    <h6 class="text-white">1. Masukkan Pelabuhan Asal Sesuai Alamat Anda</h6>
                    <h6 class="text-white">2. Masukkan Pelabuhan Tujuan Anda</h6>
                    <h6 class="text-white">3. Masukkan Tanggal Keberangkatan</h6>
                    <h6 class="text-white">4. Masukkan Tipe atau Kategori Tiket</h6>
                    <h6 class="text-white">5. Masukkan Kelas pada Deck Kapal</h6>
                    <h6 class="text-white">6. Klik Cari Sekarang!</h6>
                </div>
                <div class="col-lg-6">
                    <br>
                    <br>
                    <h1 class="text-white mb-3 text-center">Cari Tiket Kapal</h1>
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
                            <div class="col-md-6">
                                <div class="form-group date">
                                    <label class="form-label text-white" for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                    <input type="text" class="form-control rounded-0 border-0" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Tanggal Keberangkatan" data-date-days-of-week-disabled="" disabled required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="tipe_tiket-container">
                                    <label for="tipe_tiket" class="form-label text-white">Tipe Tiket</label>
                                    <select class="form-control bg-white border-0" id="tipe_tiket" name="tipe_tiket" data-placeholder="Tipe Tiket" required>
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="kelas_id-container">
                                    <label class="form-label text-white" for="kelas_id">Kelas</label>
                                    <input type="text" class="form-control" id="kelas_id" name="kelas_id" data-placeholder="Pilih Kelas" required>
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
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Hasil Pencarian Tiket</h1>
                            </div>
                            <div class="modal-body">
                                <h5>Pesan Total: <span id="hasil-total-tiket"></span> Tiket</h5>
                                <hr>
                                <div id="hasil-pencarian-container">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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
        $('#tipe_tiket').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#tipe_tiket-container")
        });
        $("#tipe_tiket").prop('disabled', true);

        $('#kelas_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#kelas_id-container")
        });
        $("#kelas_id").prop('disabled', true);

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
            $('#hasil-pencarian-container').html('');
            $('#btn-cari').attr('disabled', true);
            $('#tanggal_keberangkatan').val(null);
            $('#tanggal_keberangkatan').datepicker('destroy');
            $('#tanggal_keberangkatan > .form-control').attr('disabled', 'disabled');
            $('#tanggal_keberangkatan').attr('readonly', true);
            $("#tipe_tiket").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#tipe_tiket").prop('disabled', true);
            $("#kelas_id").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#kelas_id").prop('disabled', true);
            if($('#pelabuhan_asal_id').val() != 0 && $('#pelabuhan_tujuan_id').val() != 0){
                $('#spinner').addClass('show');
                $.ajax({
                    url: "{{ route('api.jadwal', [], false) }}",
                    type: "GET",
                    data: {
                        'pelabuhan_asal_id': $('#pelabuhan_asal_id').val(),
                        'pelabuhan_tujuan_id': $('#pelabuhan_tujuan_id').val()
                    },
                    success: function (data) {
                        $('#spinner').removeClass('show');
                        if(data.length > 0){
                            var isMoreThanToday = false;
                            data.forEach(function(value){
                                var parts = value.tanggal_keberangkatan.split('-');
                                var check_date = new Date(parts[2], parts[1]-1, parts[0]);
                                var today = new Date();
                                today.setHours(0,0,0,0);
                                if(check_date > today){
                                    isMoreThanToday = true;
                                }
                            });
                            if(isMoreThanToday){
                                $('#tanggal_keberangkatan').datepicker({
                                    beforeShowDay: function(date){
                                        check = false;
                                        data.forEach(function(value){
                                            var tanggal = date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth()+1).toString().padStart(2, '0') + '-' + date.getFullYear();
                                            if(value.tanggal_keberangkatan == tanggal){
                                                check = true;
                                            }
                                        });
                                        if(check){
                                            return {enabled: true};
                                        }else{
                                            return {enabled: false, className: 'disabled'};
                                        }
                                    },
                                    todayBtn: true,
                                    startDate: currentDate,
                                    language: 'id',
                                    zIndexOffset: 999999,
                                });
                                $('#tanggal_keberangkatan').removeAttr('disabled');
                                $('#tanggal_keberangkatan').removeAttr('readonly');
                            } else {
                                toastr.error('tidak ada tiket tersedia untuk destinasi tersebut');
                            }
                        } else {
                            toastr.error('tidak ada tiket tersedia untuk destinasi tersebut');
                        }
                    }
                });
            }
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
            $('#hasil-pencarian-container').html('');
            $('#btn-cari').attr('disabled', true);
            $('#tanggal_keberangkatan').val(null);
            $('#tanggal_keberangkatan').datepicker('destroy');
            $('#tanggal_keberangkatan > .form-control').attr('disabled', 'disabled');
            $('#tanggal_keberangkatan').attr('readonly', true);
            $("#tipe_tiket").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#tipe_tiket").prop('disabled', true);
            $("#kelas_id").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#kelas_id").prop('disabled', true);
            if($('#pelabuhan_asal_id').val() != 0 && $('#pelabuhan_tujuan_id').val() != 0){
                $('#spinner').addClass('show');
                $.ajax({
                    url: "{{ route('api.jadwal', [], false) }}",
                    type: "GET",
                    data: {
                        'pelabuhan_asal_id': $('#pelabuhan_asal_id').val(),
                        'pelabuhan_tujuan_id': $('#pelabuhan_tujuan_id').val()
                    },
                    success: function (data) {
                        $('#spinner').removeClass('show');
                        if(data.length > 0){
                            var isMoreThanToday = false;
                            data.forEach(function(value){
                                var parts = value.tanggal_keberangkatan.split('-');
                                var check_date = new Date(parts[2], parts[1]-1, parts[0]);
                                var today = new Date();
                                today.setHours(0,0,0,0);
                                if(check_date > today){
                                    isMoreThanToday = true;
                                }
                            });
                            if(isMoreThanToday){
                                $('#tanggal_keberangkatan').datepicker({
                                    beforeShowDay: function(date){
                                        check = false;
                                        data.forEach(function(value){
                                            var tanggal = date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth()+1).toString().padStart(2, '0') + '-' + date.getFullYear();
                                            if(value.tanggal_keberangkatan == tanggal){
                                                check = true;
                                            }
                                        });
                                        if(check){
                                            return {enabled: true};
                                        }else{
                                            return {enabled: false, className: 'disabled'};
                                        }
                                    },
                                    todayBtn: true,
                                    startDate: currentDate,
                                    language: 'id',
                                    zIndexOffset: 999999,
                                });
                                $('#tanggal_keberangkatan').removeAttr('disabled');
                                $('#tanggal_keberangkatan').removeAttr('readonly');
                            } else {
                                toastr.error('tidak ada tiket tersedia untuk destinasi tersebut');
                            }
                        } else {
                            toastr.error('tidak ada tiket tersedia untuk destinasi tersebut');
                        }
                    }
                });
            }
        });

        $('#tanggal_keberangkatan').on('changeDate', function(e){
            $('#spinner').addClass('show');
            $('#hasil-pencarian-container').html('');
            $('#btn-cari').attr('disabled', true);
            $("#tipe_tiket").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#tipe_tiket").prop('disabled', true);
            $("#kelas_id").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#kelas_id").prop('disabled', true);
            var date = e.date;
            var tanggal = date.getDate().toString().padStart(2, '0') + '-' + (date.getMonth()+1).toString().padStart(2, '0') + '-' + date.getFullYear();
            $.ajax({
                url: "{{ route('api.jadwal', [], false) }}",
                type: "GET",
                data: {
                    'pelabuhan_asal_id': $('#pelabuhan_asal_id').val(),
                    'pelabuhan_tujuan_id': $('#pelabuhan_tujuan_id').val(),
                    'tanggal_keberangkatan': tanggal
                },
                success: function (data) {
                    $('#spinner').removeClass('show');
                    if(data.length > 0){
                        data_tipe_tiket = []
                        data.forEach(function(value, index){
                            if(value.tipe_tiket == 1){
                                tipe_tiket_name = "Pejalan Kaki";
                            } else if(value.tipe_tiket == 2){
                                tipe_tiket_name = "Sepeda";
                            } else if(value.tipe_tiket == 3){
                                tipe_tiket_name = "Sepeda Motor";
                            } else if(value.tipe_tiket == 4){
                                tipe_tiket_name = "Mobil";
                            }

                            if(data_tipe_tiket.length == 0){
                                data_tipe_tiket.push({
                                    id: value.tipe_tiket,
                                    text: tipe_tiket_name
                                });
                            } else if (!data_tipe_tiket.find(e => e.id == value.tipe_tiket)) {
                                data_tipe_tiket.push({
                                    id: value.tipe_tiket,
                                    text: tipe_tiket_name
                                });
                            }
                        });
                        data_tipe_tiket.unshift({
                            id: '',
                            text: ''
                        });
                        $("#tipe_tiket").html('').select2({
                            theme: "bootstrap-5",
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            dropdownParent: $("#tipe_tiket-container"),
                            data: data_tipe_tiket
                        });
                        $('#tipe_tiket').prop('disabled', false);
                    }
                }
            });
        });

        $("#tipe_tiket").on('change', function(e){
            $('#spinner').addClass('show');
            $('#hasil-pencarian-container').html('');
            $('#btn-cari').attr('disabled', true);
            $("#kelas_id").html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#deck-container"),
                data: []
            });
            $("#kelas_id").prop('disabled', true);
            var tanggal =  $('#tanggal_keberangkatan').val();
            var tiket = e.value
            $.ajax({
                url: "{{ route('api.jadwal', [], false) }}",
                type: "GET",
                data: {
                    'pelabuhan_asal_id': $('#pelabuhan_asal_id').val(),
                    'pelabuhan_tujuan_id': $('#pelabuhan_tujuan_id').val(),
                    'tanggal_keberangkatan': tanggal,
                    'tipe_tiket': tiket
                },
                success: function (data) {
                    $('#spinner').removeClass('show');
                    if(data.length > 0){
                        data_kelas_id = []
                        data.forEach(function(value, index){
                            if(data_kelas_id.length == 0){
                                data_kelas_id.push({
                                    id: value.deck_id,
                                    text: value.kelas_name
                                });
                            } else if(data_kelas_id.find(e => e.id == data_kelas_id)){
                                data_kelas_id.push({
                                    id: value.deck_id,
                                    text: value.kelas_name
                                });
                            }
                        });
                        data_kelas_id.unshift({
                            id: '',
                            text: ''
                        });
                        $("#kelas_id").html('').select2({
                            theme: "bootstrap-5",
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            dropdownParent: $("#kelas_id-container"),
                            data: data_kelas_id
                        });
                        $('#kelas_id').prop('disabled', false);
                    }
                }
            });
        });

        $('#kelas_id').on('change', function(e){
            $('#spinner').addClass('show');
            $('#btn-cari').attr('disabled', true);
            $('#hasil-pencarian-container').html('');
            var tanggal =  $('#tanggal_keberangkatan').val();
            var tiket = $("#tipe_tiket").val();
            var deck = e.value;
            $.ajax({
                url: "{{ route('api.jadwal', [], false) }}",
                type: "GET",
                data: {
                    'pelabuhan_asal_id': $('#pelabuhan_asal_id').val(),
                    'pelabuhan_tujuan_id': $('#pelabuhan_tujuan_id').val(),
                    'tanggal_keberangkatan': tanggal,
                    'tipe_tiket': tiket,
                    'deck_id': deck
                },
                success: function (data) {
                    $('#spinner').removeClass('show');
                    if(data.length > 0){
                        $('#hasil-total-tiket').append(`
                            <input type="number" min:1  value="1" onChange="checkAvailableTiket(this)" id="total_pesan_tiket" />
                        `);
                        data.forEach(function(value, index){
                            $('#hasil-pencarian-container').append(`
                                    <div class="tiket mb-2 mt-2 d-flex align-items-center justify-content-between" >
                                        <div>
                                            <h4 class="mb-0">${value.nama_kapal} (${value.kode_kapal})</h4>
                                            <p class="mb-0">Kelas: ${value.kelas_name}</p>
                                            <p class="mb-0">Tanggal/Jam Berangkat: </p>
                                            <p class="mb-0">${value.tanggal_keberangkatan} ${value.jam_keberangkatan} WITA</p>
                                            <p class="mb-0">Harga: ${value.harga}</p>
                                        </div>
                                        <div id="container-btn-pesan-${value.id_jadwal}">
                                            <div class="btn-pesan btn btn-primary text-white w-100 py-3" onClick="getTicket(this)" data-id="${value.id_jadwal}" id="btn-pesan-${value.id_jadwal}">Pesan Sekarang</div>
                                        </div>
                                    </div>
                                    <hr>`);
                        });
                        $('#btn-cari').attr('disabled', false);
                    }
                }
            });
        });

        function getTicket(e){
            var id = $(e).data('id');
            var total_tiket = $('#total_pesan_tiket').val();
            var form = $('<form action="{{route("tiket.transaksi", [], false)}}" method="post">' +
                           '<input type="hidden" name="jadwal_id" value="' + id  + '" />' +
                           '<input type="hidden" name="jumlah_tiket" value="' + total_tiket  + '" />' +
                           '<input type="hidden" name="_token" value="{{ csrf_token() }}" />'+
                        '</form>');
            $('body').append(form);
            form.submit();
        }

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
