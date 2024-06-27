@extends('layouts.auth.master')
@section('title')
    Transaksi
@endsection


@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Transaksi</h5>
            </div>
        </div>
        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="2xl:col-span-3">
                            <h6 class="text-15">Daftar Transaksi</h6>
                        </div><!--end col-->
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <div class="flex gap-3">
                                <div class="relative grow">
                                    <input type="text" value="{{$search}}" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search for ..." autocomplete="off" id="search_input">
                                    <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                </div>
                                <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i class="align-baseline ltr:pr-1 rtl:pl-1 ri-download-2-line"></i> Export</button>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Tanggal Transaksi</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Nama</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Jumlah Tiket</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Status</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transaksis->isEmpty())
                                    <tr>
                                        <td colspan="6" class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 italic text-center">
                                            tidak ada data.
                                        </td>
                                    </tr>
                                @else
                                @foreach($transaksis as $transaksi)
                                <tr>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $transaksis->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ date('d-m-Y H:i:s', strtotime($transaksi->created_at)) }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $transaksi->user->fullname }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">{{ $transaksi->jumlah_tiket }}</td>
                                    @if ($transaksi->status == 'Belum Dibayar')
                                        <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">Expired : <span id="expired_time_{{$transaksi->id_transaksi}}"></span></td>
                                        <script>
                                            $(document).ready( function() {
                                                // Set the date we're counting down to
                                                var countDownDate = new Date('{{$transaksi->tanggal_expired}}').getTime();

                                                // Update the count down every 1 second
                                                var x = setInterval(function() {

                                                  // Get today's date and time
                                                  var now = new Date().getTime();

                                                  // Find the distance between now and the count down date
                                                  var distance = countDownDate - now;

                                                  // Time calculations for days, hours, minutes and seconds
                                                  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                                  // Display the result in the element with id="demo"
                                                  document.getElementById("expired_time_{{$transaksi->id_transaksi}}").innerHTML = hours + "j "
                                                  + minutes + "m " + seconds + "d ";

                                                  // If the count down is finished, write some text
                                                  if (distance < 0) {
                                                    clearInterval(x);
                                                    $.ajax({
                                                        url: "{{ route('api.transaksi.expired', [], false) }}",
                                                        type: "GET",
                                                        data: {
                                                            'id': '{{$transaksi->id_transaksi}}',
                                                        },
                                                        success: function() {
                                                            $("#expired_time_{{$transaksi->id_transaksi}}").parent().attr('colspan', 2).html("Expired");
                                                            $('#action_button_{{$transaksi->id_transaksi}}').remove();
                                                        }
                                                    })
                                                  }
                                                }, 1000);
                                            });
                                        </script>
                                    @else
                                        <td colspan="2" class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 text-center">
                                            {{ $transaksi->status }}
                                        </td>
                                    @endif
                                    @if($transaksi->status == "Belum Dibayar" && $transaksi->user_id == Auth::user()->id)
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500 flex gap-x-2" id="action_button_{{$transaksi->id_transaksi}}">
                                        <form method="post" action="{{route('transaksi.tiket.bayar')}}">
                                            @csrf
                                            <input type="hidden" name="id_transaksi" value="{{ $transaksi->id_transaksi }}">
                                            <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20 flex gap-x-2 justify-center items-center" style="	height: fit-content;"><i data-lucide="credit-card"></i> Bayar</button>
                                        </form>
                                        <button type="button" class="text-white btn bg-red-500 border-red-500 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20 flex gap-x-2 justify-center items-center" data-bs-toggle="modal" data-bs-target="#modalDeleteTransaksi{{$transaksi->id_transaksi}}" style="height: fit-content;"><i data-lucide="x"></i> Cancel</button>
                                    </td>
                                    @include('transaksi_tiket.modal.cancel');
                                    @endif
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col items-center mt-5 md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="text-slate-500 dark:text-zink-200">Showing <b> {{ $transaksis->firstItem() }} - {{ $transaksis->lastItem() }} </b> of <b>{{ $transaksis->total() }}</b> Results</p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2 shrink-0">
                            <li>
                                @if (!$transaksis->onFirstPage())
                                    <a href="{{ $transaksis->previousPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev</a>
                                @endif
                            </li>
                            @foreach (($transaksis->lastPage() < 5) ? $transaksis->getUrlRange(1, $transaksis->lastPage()) : $transaksis->getUrlRange(($transaksis->currentPage() - 4 <= 0) ? 1 : $transaksis->currentPage() - 3, ($transaksis->currentPage() < 5) ? 5 : (($transaksis->hasMorePages()) ? $transaksis->currentPage() + 1 : $transaksis->lastPage())) as $pages)
                                <li>
                                    <a href="{{ $pages }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto {{ (substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) == $transaksis->currentPage()) ? 'active' : '' }}">{{ substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) }}</a>
                                </li>
                            @endforeach
                            <li>
                                @if($transaksis->currentPage() != $transaksis->lastPage())
                                    <a href="{{ $transaksis->nextPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">Next <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
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
@endsection
