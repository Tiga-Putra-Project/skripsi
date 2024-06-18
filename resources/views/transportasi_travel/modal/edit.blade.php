<div class="modal fade" id="modalEditTransportasi{{$transportasi->id_driver}}" tabindex="-1" aria-labelledby="modalEditTransportasi{{$transportasi->id_driver}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5 text-center" id="editModalTransportasi{{$transportasi->id_driver}}">Edit Transportasi</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.transportasi.edit', $transportasi->id_driver)}}" method="POST">
        <div class="modal-body">
                @csrf
                <div class="mb-3" id="user-container{{$transportasi->id_driver}}">
                    <label for="user_id" class="form-label">Driver</label>
                    <select class="form-select" id="user_id{{$transportasi->id_driver}}" name="user_id" data-placeholder="Pilih Driver" required>
                        <option></option>
                        @foreach($users as $user)
                            <option value={{ $user->user_id }} @if($transportasi->user_id == $user->user_id) selected @endif>{{ $user->fullname }}|{{$user->user_unique_id}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3" id="kota-container{{$transportasi->id_driver}}">
                    <label for="kota_id" class="form-label">Kota Driver</label>
                    <select id="kota_id{{$transportasi->id_driver}}" class="form-control" data-placeholder="Pilih Kota Driver" name="kota_id" required>
                        <option></option>
                        @foreach ($kotas as $kota)
                            <option value={{ $kota->id }} @if($kota->id == $transportasi->kota_id) selected @endif>{{$kota->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_kendaraan" class="form-label">Nama Kendaraan</label>
                    <input type="text" id="nama_kendaraan" class="form-control" placeholder="Nama Kendaraan" name="nama_kendaraan" value="{{$transportasi->nama_kendaraan}}" required>
                </div>
                <div class="mb-3">
                    <label for="plat_kendaraan" class="form-label">Plat Kendaraan</label>
                    <input type="text" id="plat_kendaraan" class="form-control" placeholder="Plat Kendaraan" name="plat_kendaraan" value="{{$transportasi->plat_kendaraan}}" required>
                </div>
                <div class="mb-3">
                    <label for="kapasitas_penumpang" class="form-label">Jumlah Maksimal Penumpang</label>
                    <input type="number" min="1" id="kapasitas_penumpang" class="form-control" placeholder="Plat Kendaraan" name="kapasitas_penumpang" value="{{$transportasi->kapasitas_penumpang}}" required>
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Edit Transportasi</button>
        </div>
        </form>
        </div>
    </div>
</div>
<script>
    var id_transportasi = {{$transportasi->id_driver}};
    $(`#user_id${id_transportasi}`).select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $(`#user-container${id_transportasi}`)
    });

    $(`#kota_id${id_transportasi}`).select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $(`#kota-container${id_transportasi}`)
    });

    $(`#user_id${id_transportasi}`).on("select2:open", function () {
        setTimeout(function () {
            var liElements = $(`#select2-user_id${id_transportasi}-results li`);
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

    $(`#user_id${id_transportasi}`).on('change', function() {
        setTimeout(function () {
            var elements = $(`#select2-user_id${id_transportasi}-container`);
            var text = elements[0].innerText.split('|');
            elements[0].innerText = `${text[0]} (${text[1]})`;
        }, 0);
    });

    setTimeout(function () {
        var elements = $(`#select2-user_id${id_transportasi}-container`);
        var text = elements[0].innerText.split('|');
        elements[0].innerHTML = `${text[0]} (${text[1]})`;
    }, 0);

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
</script>
