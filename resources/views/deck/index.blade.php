@extends('layouts.auth.master')

@section('content')
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Deck</h5>
            </div>
        </div>
        <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
            <div class="col-span-12 card 2xl:col-span-12">
                <div class="card-body">
                    <div class="grid items-center grid-cols-1 gap-3 mb-5 2xl:grid-cols-12">
                        <div class="2xl:col-span-3">
                            <h6 class="text-15">Daftar Deck</h6>
                        </div><!--end col-->
                        <div class="2xl:col-span-3 2xl:col-start-10">
                            <div class="flex gap-3">
                                <div class="relative grow">
                                    <input type="text" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search for ..." autocomplete="off" id="search_input">
                                    <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                                </div>
                                <button data-bs-toggle="modal" data-bs-target="#addDeck" type="button" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus inline-block size-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg> <span class="align-middle">Tambah Deck</span></button>
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
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">
                                        Nama Kapal
                                    </th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">ID Kapal</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Kelas</th>
                                    <th class="px-3.5 py-2.5 first:pl-5 last:pr-5 font-semibold border-y border-slate-200 dark:border-zink-500">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($decks as $deck)
                                <tr>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $decks->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $deck->kapal->nama_kapal }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $deck->kapal->kode_kapal }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        {{ $deck->kelas }}
                                    </td>
                                    <td class="px-3.5 py-2.5 first:pl-5 last:pr-5 border-y border-slate-200 dark:border-zink-500">
                                        @if($user->role != 'admin')
                                        <div class="relative dropdown">
                                            <button id="orderAction{{ $deck->id_deck }}" data-bs-toggle="dropdown" class="flex items-center justify-center size-[30px] dropdown-toggle p-0 text-slate-500 btn bg-slate-100 hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20"><i data-lucide="more-horizontal" class="size-3"></i></button>
                                            <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $deck->id_deck }}">
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="apps-ecommerce-order-overview.html"><i data-lucide="square-pen" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Edit</span></a>
                                                </li>
                                                <li>
                                                    <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#" data-bs-toggle="modal" data-bs-target="#modalDeleteDeck{{$deck->id_deck}}"><i data-lucide="trash-2" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i><span class="align-middle">Delete</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @include('deck.modal.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col items-center mt-5 md:flex-row">
                        <div class="mb-4 grow md:mb-0">
                            <p class="text-slate-500 dark:text-zink-200">Showing <b> {{ $decks->firstItem() }} - {{ $decks->lastItem() }} </b> of <b>{{ $decks->total() }}</b> Results</p>
                        </div>
                        <ul class="flex flex-wrap items-center gap-2 shrink-0">
                            <li>
                                @if (!$decks->onFirstPage())
                                    <a href="{{ $decks->previousPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto"><i class="mr-1 size-4 rtl:rotate-180" data-lucide="chevron-left"></i> Prev</a>
                                @endif
                            </li>
                            @foreach (($decks->lastPage() < 5) ? $decks->getUrlRange(1, $decks->lastPage()) : $decks->getUrlRange(($decks->currentPage() - 4 <= 0) ? 1 : $decks->currentPage() - 3, ($decks->currentPage() < 5) ? 5 : (($decks->hasMorePages()) ? $decks->currentPage() + 1 : $decks->lastPage())) as $pages)
                                <li>
                                    <a href="{{ $pages }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 w-8 h-8 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto {{ (substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) == $decks->currentPage()) ? 'active' : '' }}">{{ substr($pages, (strpos($pages,'page=') + 5), strlen($pages)) }}</a>
                                </li>
                            @endforeach
                            <li>
                                @if($decks->currentPage() != $decks->lastPage())
                                    <a href="{{ $decks->nextPageUrl() }}{{ ($search) ? '&search='.$search : '' }}" class="inline-flex items-center justify-center bg-white dark:bg-zink-700 h-8 px-3 transition-all duration-150 ease-linear border rounded border-slate-200 dark:border-zink-500 text-slate-500 dark:text-zink-200 hover:text-custom-500 dark:hover:text-custom-500 hover:bg-custom-50 dark:hover:bg-custom-500/10 focus:bg-custom-50 dark:focus:bg-custom-500/10 focus:text-custom-500 dark:focus:text-custom-500 [&.active]:text-custom-500 dark:[&.active]:text-custom-500 [&.active]:bg-custom-50 dark:[&.active]:bg-custom-500/10 [&.active]:border-custom-50 dark:[&.active]:border-custom-500/10 [&.active]:hover:text-custom-700 dark:[&.active]:hover:text-custom-700 [&.disabled]:text-slate-400 dark:[&.disabled]:text-zink-300 [&.disabled]:cursor-auto">Next <i class="ml-1 size-4 rtl:rotate-180" data-lucide="chevron-right"></i></a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addDeck" tabindex="-1" aria-labelledby="tambahModalDeck" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="tambahModalDeck">Tambah Deck</h1>
                </div>
                <form action="{{ route('admin.deck.submit')}}" method="POST">
                <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="kapal_id" class="form-label">Kapal</label>
                            <select class="form-select" id="kapal_id" name="kapal_id" data-placeholder="Kapal">
                                <option></option>
                                <option value="ue">Halo</option>
                                <option value="ae">Kamu</option>
                                <option value="ehe">Hitam</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Deckname" class="form-label">Deckname</label>
                            <input type="text" class="form-control" id="Deckname" name="Deckname" placeholder="Deckname">
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="text-white btn bg-lime-400 border-lime-400 hover:text-white hover:bg-lime-500 hover:border-lime-400 focus:text-white focus:bg-lime-500 focus:border-lime-500 focus:ring focus:ring-lime-500 active:text-white active:bg-lime-400 active:border-lime-400 active:ring active:ring-lime-400 dark:ring-custom-400/20">Add User</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $("#kapal_id").select2({
        theme: "bootstrap-5",
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
    });
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
