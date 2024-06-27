@extends('layouts.auth.master')

@section('title')
    List Jadwal
@endsection

@section('content')
<script>
    const date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    month = month.toString().padStart(2, '0');
    let year = date.getFullYear();

    let currentDate = `${day}-${month}-${year}`

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
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Jadwal</h5>
            </div>
        </div>
        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="2xl:col-span-3">
                            <h6 class="text-15">Daftar Jadwal</h6>
                        </div><!--end col-->
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <div class="flex gap-3">
                                <div class="relative grow">
                                    <input type="text" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search for ..." autocomplete="off" id="search_input" value="{{$search}}">
                                    <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                </div>
                                @if(Auth::user()->hasRole('admin'))
                                <button data-bs-toggle="modal" data-bs-target="#addJadwal" type="button" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus inline-block size-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg> <span class="align-middle">Tambah jadwal</span></button>
                                <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export</button>
                                @endif
                            </div>
                        </div><!--end col-->
                    </div><!--end grid-->
                    <div class="overflow-x-auto">
                        <table class="w-full whitespace-nowrap">
                            <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                                <tr>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        No.
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Kapal</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Kelas</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Tipe Tiket</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Jadwal Keberangatan</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Jalur</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Jumlah Tiket</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Harga</th>
                                    @if(Auth::user()->hasRole('admin'))
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="dark:text-zink-200">
                                @if($jadwals->isEmpty())
                                    <tr>
                                        <td colspan="9" class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 italic text-center">
                                            tidak ada data.
                                        </td>
                                    </tr>
                                @else
                                @foreach($jadwals as $jadwal)
                                <tr>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $jadwals->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        ({{ $jadwal->kapal->kode_kapal }}) {{ $jadwal->kapal->nama_kapal }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $jadwal->deck->kelas }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $jadwal->tipeTiket() }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $jadwal->tanggal_keberangkatan}} {{ $jadwal->jam_keberangkatan }}</td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        <p>{{ $jadwal->kotaAsal->tempat_pelabuhan }} <i data-lucide="move-right" class="inline"></i> {{ $jadwal->kotaTujuan->tempat_pelabuhan }}</p>
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        Tersedia: {{ $jadwal->totalTiketTransaksi() }}/{{ $jadwal->jumlah_tiket }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        Rp. {{number_format($jadwal->harga, 0, ',', '.')}}
                                    </td>
                                    @if(Auth::user()->hasRole('admin'))
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        <div class="relative dropdown select-none">
                                            <button id="orderAction{{ $jadwal->id_jadwal }}" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"><i data-lucide="more-horizontal" class="size-3"></i></button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $jadwal->id_jadwal }}">
                                                <li>
                                                    <span class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200 cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditJadwal{{$jadwal->id_jadwal}}"><i data-lucide="pencil" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Edit</span></span>
                                                </li>
                                                <li>
                                                    <span class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" data-bs-toggle="modal" data-bs-target="#modalDeleteJadwal{{$jadwal->id_jadwal}}"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1 cursor-pointer"></i><span class="align-middle">Delete</span></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @include('jadwal.modal.edit')
                                @include('jadwal.modal.delete')
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col items-center mt-5 md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="text-slate-500 dark:text-zink-200">Showing <b> {{ $jadwals->firstItem() }} - {{ $jadwals->lastItem() }} </b> of <b>{{ $jadwals->total() }}</b> Results</p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2 shrink-0">
                            <li>
                                @if (!$jadwals->onFirstPage())
                                    <a href="{{ $jadwals->previousPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev</a>
                                @endif
                            </li>
                            @foreach (($jadwals->lastPage() < 5) ? $jadwals->getUrlRange(1, $jadwals->lastPage()) : $jadwals->getUrlRange(($jadwals->currentPage() - 4 <= 0) ? 1 : $jadwals->currentPage() - 3, ($jadwals->currentPage() < 5) ? 5 : (($jadwals->hasMorePages()) ? $jadwals->currentPage() + 1 : $jadwals->lastPage())) as $pages)
                                <li>
                                    <a href="{{ $pages }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto {{ (substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) == $jadwals->currentPage()) ? 'active' : '' }}">{{ substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) }}</a>
                                </li>
                            @endforeach
                            <li>
                                @if($jadwals->currentPage() != $jadwals->lastPage())
                                    <a href="{{ $jadwals->nextPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">Next <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->hasRole('admin'))
        <!-- Modal -->
        <div class="modal fade" id="addJadwal" tabindex="-1" aria-labelledby="tambahModalJadwal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="tambahModalJadwal">Tambah Jadwal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.jadwal.submit', [], false)}}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="kapal_id" class="form-label">Kapal</label>
                            <select class="form-select" id="kapal_id" name="kapal_id" data-placeholder="Pilih kapal yang anda inginkan" required>
                                @if($kapals->isEmpty())
                                    <option disabled>Tidak Ada Data Kapal.</option>
                                @else
                                    <option></option>
                                    @foreach ($kapals as $kapal)
                                        <option value="{{ $kapal->id_kapal }}">{{ $kapal->kode_kapal }} | {{ $kapal->nama_kapal }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="mb-3" id="tipe_tiket-container">
                            <label for="tipe_tiket" class="form-label">Tipe Tiket</label>
                            <select class="form-select" id="tipe_tiket" name="tipe_tiket" data-placeholder="Pilih Tipe Tiket" required>
                                    <option></option>
                                    <option value="1">Pejalan Kaki</option>
                                    <option value="2">Sepeda</option>
                                    <option value="3">Sepeda Motor</option>
                                    <option value="4">Mobil</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                            <input type="text" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Tanggal Keberangkatan" data-date-days-of-week-disabled="" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_tiket" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control" id="jumlah_tiket" name="jumlah_tiket" placeholder="Jumlah tiket yang dapat dipesan" min="1" max="1" required disabled>
                        </div>
                        <div class="mb-3" id="deck-container">
                            <label for="deck_id" class="form-label">Kelas Kapal</label>
                            <select class="form-select" id="deck_id" name="deck_id" data-placeholder="Pilih Kelas Kapal" required>
                                <option></option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                            <input type="time" class="form-control" id="jam_keberangkatan" name="jam_keberangkatan" placeholder="Jam Keberangkatan" onfocus="this.showPicker()" required>
                        </div>
                        <div class="mb-3" id="asal-container">
                            <label for="asal" class="form-label">Asal</label>
                            <select class="form-select" id="asal" name="pelabuhan_asal_id" data-placeholder="Pilih Pelabuhan Asal" required>
                                <option></option>
                                @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->id}}">
                                        {{$pelabuhan->nama_kota}}, {{$pelabuhan->nama_provinsi}}|{{$pelabuhan->kode_pelabuhan }} - {{$pelabuhan->tempat_pelabuhan}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" id="tujuan-container">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <select class="form-select" id="tujuan" name="pelabuhan_tujuan_id" data-placeholder="Pilih Pelabuhan Tujuan" required>
                                <option></option>
                                @foreach ($pelabuhans as $pelabuhan)
                                    <option value="{{$pelabuhan->id}}">
                                        {{$pelabuhan->nama_kota}}, {{$pelabuhan->nama_provinsi}}|{{$pelabuhan->kode_pelabuhan }} - {{$pelabuhan->tempat_pelabuhan}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Tiket</label>
                            <input type="text" class="form-control" name="harga" id="currency-field" pattern="^\Rp\d{1,3}(.\d{3})?$" value="" data-type="currency" placeholder="Harga Tiket" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Tambah Jadwal</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@section('js')
<script>
    $('#tanggal_keberangkatan').datepicker({
        todayHighlight: true,
        todayBtn: true,
        startDate: currentDate,
        language: 'id'
    });

    $("#tipe_tiket").select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#tipe_tiket-container")
    });

    $("#kapal_id").select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#addJadwal")
    });

    $("#kapal_id").on('change', function(){
        $("#jumlah_tiket").val('');
        $("#jumlah_tiket").attr('disabled', 'disabled');
        $("#deck_id").html('').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $("#deck-container"),
            data: []
        });
        $("#deck_id").prop('disabled', true);
        $.ajax({
            url: "{{ route('api.kapal', [], false) }}",
            type: "GET",
            data: {
                id: this.value
            },
            success: function (data) {
                $("#jumlah_tiket").val(data.kapal.kapasitas);
                $("#jumlah_tiket").attr('max', data.kapal.kapasitas);
                $("#jumlah_tiket").removeAttr('disabled');
                if(data.deck.length > 0){
                    data.deck.unshift({
                        id: '',
                        text: ''
                    })
                    $("#deck_id").html('').select2({
                        theme: "bootstrap-5",
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                        dropdownParent: $("#deck-container"),
                        data: data.deck
                    });
                    $('#deck_id').prop('disabled', false);
                } else {
                    toastr.info('tidak ada kelas untuk kode kapal ' + data.kapal.kode_kapal);
                }
            }
        });
    });

    $("#deck_id").select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#addJadwal")
    });

    $('#deck_id').prop('disabled', true);

    $('#asal').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#asal-container"),
        templateResult: formatState
    });

    $('#asal').on('change', function() {
        setTimeout(function () {
            var elements = $('#select2-asal-container');
            var text = elements[0].innerText.split('|');
            elements[0].innerText = `${text[0]} (${text[1]})`;
        }, 0);
    })

    $('#tujuan').select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#tujuan-container"),
        templateResult: formatState
    });

    $('#tujuan').on('change', function() {
        setTimeout(function () {
            var elements = $('#select2-tujuan-container');
            var text = elements[0].innerText.split('|');
            elements[0].innerText = `${text[0]} (${text[1]})`;
        }, 0);
    })

    document.getElementById('search_input').addEventListener('keypress', function(e){
        if(e.key === 'Enter'){
            let link;
            if(window.location.href.includes('?')){
                link = window.location.href.slice(0, window.location.href.indexOf('?'));
            } else {
                link = window.location.href
            }
            window.location = link+'?search='+e.target.value;
        }
    });

    $("input[data-type='currency']").on({
        keyup: function() {
            formatCurrency($(this));
        },
        blur: function() {
            formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }


    function formatCurrency(input, blur) {
        var input_val = input.val();
        if (input_val === "") { return; }
        var original_len = input_val.length;
        var caret_pos = input.prop("selectionStart");
        if (input_val.indexOf(",") >= 0) {
            input_val = formatNumber(input_val);
            input_val = "Rp. " + input_val;
        } else {
            input_val = formatNumber(input_val);
            input_val = "Rp. " + input_val;
        }
        input.val(input_val);
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>
@endsection
