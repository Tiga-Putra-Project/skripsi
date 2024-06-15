<div class="modal fade" id="modalEditJadwal{{$jadwal->id_jadwal}}" tabindex="-1" aria-labelledby="editModalJadwal{{$jadwal->id_jadwal}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="editModalJadwal{{$jadwal->id_jadwal}}">Edit Jadwal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.jadwal.edit', $jadwal->id_jadwal)}}" method="POST">
        <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kapal_id" class="form-label">Kapal</label>
                    <select class="form-select" id="select_kapal{{ $jadwal->id_jadwal }}" name="kapal_id" data-placeholder="Pilih kapal yang anda inginkan" data-modal="#modalEditJadwal{{ $jadwal->id_jadwal }}">
                        <option></option>
                        @foreach ($kapals as $kapal)
                            <option value="{{ $kapal->id_kapal }}" {{ ($jadwal->kapal_id == $kapal->id_kapal) ? 'selected' : '' }}>{{ $kapal->kode_kapal }} | {{ $kapal->nama_kapal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jadwal" class="form-label">Jadwal Keberangkatan</label>
                    <input type="text" class="form-control" id="jadwal_keberangkatan{{ $jadwal->id_jadwal }}" name="jadwal_keberangkatan" placeholder="Jadwal Keberangkatan" value="{{$jadwal->jadwal_keberangkatan}}" required>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Edit Jadwal</button>
        </div>
        </form>
        </div>
    </div>
    <script>
        var id_jadwal = {{ $jadwal->id_jadwal }};
        $(`#select_kapal${id_jadwal}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#modalEditJadwal${id_jadwal}`)
        });

        $(`#jadwal_keberangkatan${id_jadwal}`).datepicker({
            todayHighlight: true,
            todayBtn: true,
            daysOfWeekDisabled: [0,6],
            startDate: currentDate,
            language: 'id'
        });
    </script>
</div>
