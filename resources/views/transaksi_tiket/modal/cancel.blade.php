<form method="GET" action="{{ route('tansaksi.tiket.cancel',$transaksi->id_transaksi, false) }}">
    @csrf
    <div class="modal fade" id="modalDeleteTransaksi{{$transaksi->id_transaksi}}" tabindex="-1" aria-labelledby="modalDeleteTransaksi{{$transaksi->id_transaksi}}" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="modalDeleteTransaksi{{$transaksi->id_transaksi}}">Batalkan Transaksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                    <p>Apakah Anda Yakin?</p>
                    <p>Ingin membatalkan Transaksi ini ?</p>
                </div>
            <div class="modal-footer">
                <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="text-white btn bg-red-400 border-red-400 hover:text-white hover:bg-red-500 hover:border-red-400 focus:text-white focus:bg-red-500 focus:border-red-500 focus:ring focus:ring-red-500 active:text-white active:bg-red-400 active:border-red-400 active:ring active:ring-red-400 dark:ring-custom-400/20">Batalkan</button>
            </div>
            </div>
        </div>
    </div>
    </form>
