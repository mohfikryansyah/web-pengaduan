@extends('master.auth-main')

@section('content')
    <div class="px-5">
        <div
            class="pt-3 flex flex-column sm:flex-row flex-wrap space-y-4 md:space-y-0 items-center justify-between pb-4 overflow-hidden">
            <div class="w-full md:w-auto md:inline-flex md:space-x-4 md:space-y-0 space-y-2">
                <div class="bg-yellow-400 max-w-sm text-gray-100 rounded-lg px-3 py-1.5">
                    <h1 class="font-bold text-center">{{ $pengaduan->where('kategori', 'Pungutan Liar')->count() }} Laporan
                        Pungutan
                        Liar</h1>
                </div>
                <div class="bg-yellow-400 max-w-sm text-gray-100 rounded-lg px-3 py-1.5">
                    <h1 class="font-bold text-center">{{ $pengaduan->where('kategori', 'Gratifikasi')->count() }} Laporan
                        Gratifikasi
                    </h1>
                </div>
                <div class="bg-yellow-400 max-w-sm text-gray-100 rounded-lg px-3 py-1.5">
                    <h1 class="font-bold text-center">{{ $pengaduan->where('kategori', 'Korupsi')->count() }} Laporan Korupsi
                    </h1>
                </div>
            </div>

            <form action="{{ route('dashboard.index') }}">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div
                        class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="search" id="table-search" name="tahun"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari tahun" value="{{ request('tahun') }}">
                </div>
            </form>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-100 uppercase bg-yellow-400 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Judul Laporan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Isi Laporan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Kejadian
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Selesai
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Durasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lokasi Kejadian
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lampiran
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengaduan as $data)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $data->nama }}
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($data->status == 'Baru')
                                    <span
                                        class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                        <span class="w-2 h-2 mr-1 bg-green-500 rounded-2xl"></span>
                                        {{ $data->status }}
                                    </span>
                                @elseif ($data->status == 'Sedang diproses')
                                    <span
                                        class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                                        <span class="w-2 h-2 mr-1 bg-yellow-500 rounded-2xl"></span>
                                        {{ $data->status }}
                                    </span>
                                @elseif ($data->status == 'Ditolak')
                                    <span
                                        class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 mr-1 bg-red-500 rounded-2xl"></span>
                                        {{ $data->status }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                        <span class="w-2 h-2 mr-1 bg-blue-500 rounded-2xl"></span>
                                        {{ $data->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $data->judul }}
                            </td>
                            <td class="px-6 py-4">
                                <!-- Modal toggle -->
                                <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                                    class="block text-blue-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    Lihat
                                </button>

                                <!-- Main modal -->
                                <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Laporan
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="static-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <p class="text-lg leading-relaxed text-gray-800 dark:text-gray-400">
                                                    {{ $data->judul }}
                                                </p>
                                                <p class="text-base leading-relaxed text-gray-700 dark:text-gray-400">
                                                    {{ $data->pesan }}
                                                </p>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="static-modal" type="button"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->tanggal }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->tanggal_selesai }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->durasi }} Hari
                            </td>
                            <td class="px-6 py-4">
                                {{ $data->lokasi }}
                            </td>
                            <td class="px-6 py-4">
                                <a class="text-blue-500 font-semibold" href="{{ asset('storage/' . $data->file_input) }}"
                                    target="_blank">Lihat</a>
                            </td>
                            <td class="px-6 py-4">
                                @if ($data->status == 'Baru')
                                    <a href="{{ route('sendEmail', ['id' => $data->id]) }}" class="text-blue-500"
                                        onclick="return confirm('Anda yakin untuk memproses laporan ini?')">Proses |</a>
                                    <a href="{{ route('tolakEmail', ['id' => $data->id]) }}" class="text-blue-500"
                                        onclick="return confirm('Anda yakin untuk menolak laporan ini?')">Tolak</a>
                                @elseif ($data->status == 'Sedang diproses')
                                    <a href="{{ route('sendEmail', ['id' => $data->id]) }}" class="text-blue-500"
                                        onclick="return confirm('Anda yakin untuk menyelesaikan laporan ini?')">Selesaikan</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row" colspan="10"
                                class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                KOSONG
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
