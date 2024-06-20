<div class="modal fade" id="modalEditKapal{{ $kapal->id_kapal }}" tabindex="-1" aria-labelledby="editModalKapal{{$kapal->id_kapal}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="editModalKapal{{$kapal->id_kapal}}">Edit Kapal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.kapal.edit', $kapal->id_kapal, false)}}" method="POST">
        <div class="modal-body">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" placeholder="Nama Kapal" value="{{$kapal->nama_kapal}}" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Kapasitas" min="1" value="{{$kapal->kapasitas}}" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Edit Kapal</button>
        </div>
        </form>
        </div>
    </div>
</div>
