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
                <div class="mb-3" id="kapal-container{{$jadwal->id_jadwal}}">
                    <label for="kapal_id{{$jadwal->id_jadwal}}" class="form-label">Kapal</label>
                    <select class="form-select" id="kapal_id{{$jadwal->id_jadwal}}" name="kapal_id" data-placeholder="Pilih kapal yang anda inginkan" required>
                        @if($kapals->isEmpty())
                            <option disabled>Tidak Ada Data Kapal.</option>
                        @else
                            <option></option>
                            @foreach ($kapals as $kapal)
                                <option value="{{ $kapal->id_kapal }}" @if($jadwal->kapal_id == $kapal->id_kapal) selected @endif>{{ $kapal->kode_kapal }} | {{ $kapal->nama_kapal }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tanggal_keberangkatan{{$jadwal->id_jadwal}}" class="form-label">Tanggal Keberangkatan</label>
                    <input type="text" class="form-control" id="tanggal_keberangkatan{{$jadwal->id_jadwal}}" name="tanggal_keberangkatan" placeholder="Tanggal Keberangkatan" value="{{$jadwal->tanggal_keberangkatan}}" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tiket{{$jadwal->id_jadwal}}" class="form-label">Jumlah Tiket</label>
                    <input type="number" class="form-control" id="jumlah_tiket{{$jadwal->id_jadwal}}" name="jumlah_tiket" placeholder="Jumlah tiket yang dapat dipesan" min="1" max="1" value="{{$jadwal->jumlah_tiket}}" required>
                </div>
                <div class="mb-3" id="deck-container{{$jadwal->id_jadwal}}">
                    <label for="deck_id{{$jadwal->id_jadwal}}" class="form-label">Kelas Kapal</label>
                    <select class="form-select" id="deck_id{{$jadwal->id_jadwal}}" name="deck_id" data-placeholder="Pilih Kelas Kapal" required>
                        <option></option>
                        @foreach(App\Models\Deck::where('kapal_id', $jadwal->kapal_id)->get() as $deck)
                            <option value="{{$deck->id_deck}}" @if($jadwal->deck_id == $deck->id_deck) selected @endif>{{ $deck->kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jam_keberangkatan{{$jadwal->id_jadwal}}" class="form-label">Jam Keberangkatan</label>
                    <input type="time" class="form-control" id="jam_keberangkatan{{$jadwal->id_jadwal}}" name="jam_keberangkatan" placeholder="Jam Keberangkatan" onfocus="this.showPicker()" value="{{$jadwal->jam_keberangkatan}}" required>
                </div>
                <div class="mb-3" id="asal-container{{$jadwal->id_jadwal}}">
                    <label for="asal{{$jadwal->id_jadwal}}" class="form-label">Asal</label>
                    <select class="form-select" id="asal{{$jadwal->id_jadwal}}" name="pelabuhan_asal_id" data-placeholder="Pilih Pelabuhan Asal" required>
                        <option></option>
                        @foreach ($pelabuhans as $pelabuhan)
                            <option value="{{$pelabuhan->id}}" @if($jadwal->pelabuhan_asal_id == $pelabuhan->id) selected @endif>
                                {{$pelabuhan->nama_kota}}, {{$pelabuhan->nama_provinsi}}|{{$pelabuhan->kode_pelabuhan }} - {{$pelabuhan->tempat_pelabuhan}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="tujuan-container{{$jadwal->id_jadwal}}">
                    <label for="tujuan{{$jadwal->id_jadwal}}" class="form-label">Tujuan</label>
                    <select class="form-select" id="tujuan{{$jadwal->id_jadwal}}" name="pelabuhan_tujuan_id" data-placeholder="Pilih Pelabuhan Tujuan" required>
                        <option></option>
                        @foreach ($pelabuhans as $pelabuhan)
                            <option value="{{$pelabuhan->id}}" @if($jadwal->pelabuhan_tujuan_id == $pelabuhan->id) selected @endif>
                                {{$pelabuhan->nama_kota}}, {{$pelabuhan->nama_provinsi}}|{{$pelabuhan->kode_pelabuhan }} - {{$pelabuhan->tempat_pelabuhan}}
                            </option>
                        @endforeach
                    </select>
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
        $(`#kapal_id${id_jadwal}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#kapal-container${id_jadwal}`)
        });

        $(`#kapal_id${id_jadwal}`).on('change', function(){
            $(`#jumlah_tiket${id_jadwal}`).val('');
            $(`#jumlah_tiket${id_jadwal}`).attr('disabled', 'disabled');
            $(`#deck_id${id_jadwal}`).html('').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $(`#deck-container${id_jadwal}`),
                data: []
            });
            $(`#deck_id${id_jadwal}`).prop('disabled', true);
            $.ajax({
                url: "{{ route('api.kapal') }}",
                type: "GET",
                data: {
                    id: this.value
                },
                success: function (data) {
                    $(`#jumlah_tiket${id_jadwal}`).val(data.kapal.kapasitas);
                    $(`#jumlah_tiket${id_jadwal}`).attr('max', data.kapal.kapasitas);
                    $(`#jumlah_tiket${id_jadwal}`).removeAttr('disabled');
                    if(data.deck.length > 0){
                        data.deck.unshift({
                            id: '',
                            text: ''
                        })
                        $(`#deck_id${id_jadwal}`).html('').select2({
                            theme: "bootstrap-5",
                            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                            placeholder: $(this).data('placeholder'),
                            dropdownParent: $(`#deck-container${id_jadwal}`),
                            data: data.deck
                        });
                        $(`#deck_id${id_jadwal}`).prop('disabled', false);
                    } else {
                        toastr.info('tidak ada kelas untuk kode kapal ' + data.kapal.kode_kapal);
                    }
                }
            });
        });

        $(`#deck_id${id_jadwal}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#deck-container${id_jadwal}`)
        });

        $(`#asal${id_jadwal}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#asal-container${id_jadwal}`)
        });

        $(`#asal${id_jadwal}`).on("select2:open", function () {
            setTimeout(function () {
                var liElements = $(`#select2-asal${id_jadwal}-results li`);
                liElements.each(function () {
                    var text = this.innerText.split('|');
                    this.innerText = '';
                    var parentDiv = document.createElement('div');
                    var childDiv = document.createElement('div');
                    var childDiv2 = document.createElement('div');
                    parentDiv.className = 'row';
                    childDiv.className = 'col-md-12 font-bold';
                    childDiv2.className = 'col-md-12 text-sm';

                    childDiv.appendChild(document.createTextNode(text[0]));
                    childDiv2.appendChild(document.createTextNode(text[1]));
                    parentDiv.appendChild(childDiv);
                    parentDiv.appendChild(childDiv2);
                    this.appendChild(parentDiv);
                });
            }, 0);
        });

        $(`#asal${id_jadwal}`).on('change', function() {
            setTimeout(function () {
                var elements = $(`#select2-asal${id_jadwal}-container`);
                var text = elements[0].innerText.split('|');
                elements[0].innerText = `${text[0]} (${text[1]})`;
            }, 0);
        })

        $(`#tujuan${id_jadwal}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#tujuan-container${id_jadwal}`)
        });

        $(`#tujuan${id_jadwal}`).on("select2:open", function () {
            setTimeout(function () {
                var liElements = $(`#select2-tujuan${id_jadwal}-results li`);
                liElements.each(function () {
                    var text = this.innerText.split('|');
                    this.innerText = '';
                    var parentDiv = document.createElement('div');
                    var childDiv = document.createElement('div');
                    var childDiv2 = document.createElement('div');
                    parentDiv.className = 'row';
                    childDiv.className = 'col-md-12 font-bold';
                    childDiv2.className = 'col-md-12 text-sm';

                    childDiv.appendChild(document.createTextNode(text[0]));
                    childDiv2.appendChild(document.createTextNode(text[1]));
                    parentDiv.appendChild(childDiv);
                    parentDiv.appendChild(childDiv2);
                    this.appendChild(parentDiv);
                });
            }, 0);
        });

        $(`#tujuan${id_jadwal}`).on('change', function() {
            setTimeout(function () {
                var elements = $(`#select2-tujuan${id_jadwal}-container`);
                var text = elements[0].innerText.split('|');
                elements[0].innerText = `${text[0]} (${text[1]})`;
            }, 0);
        })

        $(`#tanggal_keberangkatan${id_jadwal}`).datepicker({
            todayHighlight: true,
            todayBtn: true,
            daysOfWeekDisabled: [0,6],
            startDate: currentDate,
            language: 'id'
        });

        $(document).ready(function() {
            setTimeout(function () {
                var elements = $(`#select2-asal${id_jadwal}-container`);
                var text = elements[0].innerText.split('|');
                elements[0].innerHTML = `${text[0].replace(/ /g,'')} (${text[1].replace(/ /g,'')})`;
            }, 0);

            setTimeout(function () {
                var elements = $(`#select2-tujuan${id_jadwal}-container`);
                var text = elements[0].innerText.split('|');
                elements[0].innerHTML = `${text[0].replace(/ /g,'')} (${text[1].replace(/ /g,'')})`;
            }, 0);
        });
    </script>
</div>
