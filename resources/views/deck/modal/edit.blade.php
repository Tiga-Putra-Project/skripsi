<div class="modal fade" id="editDeck{{ $deck->id_deck }}" tabindex="-1" aria-labelledby="editModalDeck{{ $deck->id }}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="editModalDeck{{ $deck->id_deck }}">Edit Deck</h1>
        </div>
        <form action="{{ route('admin.deck.edit', $deck->id_deck, false)}}" method="POST">
        <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kapal_id" class="form-label">Kapal</label>
                    <select class="form-select" id="select_kapal{{ $deck->id_deck }}" name="kapal_id" data-placeholder="Pilih kapal yang anda inginkan" data-modal="#editDeck{{ $deck->id_deck }}">
                        <option></option>
                        @foreach ($kapals as $kapal)
                            <option value="{{ $kapal->id_kapal }}" {{ ($deck->kapal_id == $kapal->id_kapal) ? 'selected' : '' }}>{{ $kapal->kode_kapal }} | {{ $kapal->nama_kapal }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Nama Deck/Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Nama Deck/Kelas" value="{{ $deck->kelas }}">
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Edit Deck Kapal</button>
        </div>
        </form>
        </div>
    </div>
    <script>
        var id_deck = {{ $deck->id_deck }};
        $(`#select_kapal${id_deck}`).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $(`#editDeck${id_deck}`)
        });
    </script>
</div>
