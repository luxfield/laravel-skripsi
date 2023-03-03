<form>
    <div class="relative my-3">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <input type="search" id="search"
            class="font-medium block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-center"
            placeholder="Masukkan nomor SIPB" required>
        <button type="submit"
            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 text-center">Cari</button>
    </div>
</form>
<div class="overflow-y-auto relative">
    <table class=" text-sm text-left text-gray-500 dark:text-gray-400" id="table_schedule">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nomor Pengiriman
                </th>
                <th scope="col" class="py-3 px-6">
                    Nomor Surat Jalan
                </th>
                <th scope="col" class="py-3 px-6">
                    Nama Penerima
                </th>
                <th scope="col" class="py-3 px-6">
                    Perusahaan
                </th>

                <th scope="col" class="py-3 px-6">
                    Alamat
                </th>
                <th scope="col" class="py-3 px-6">
                    Pekerjaan
                </th>
                <th scope="col" class="py-3 px-6">
                    Jarak Tempuh
                </th>
                <th scope="col" class="py-3 px-6">
                    Estimasi
                </th>
                <th scope="col" class="py-3 px-6">
                    Tanggal Berangkat
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>

                {{-- <th scope="col" class="py-3 px-6">
                    Aksi
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($data_jadwal as $key => $jadwal)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('detail data jadwal', ['id' => $jadwal->nomor_pengiriman]) }}"
                            class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $jadwal->nomor_pengiriman }}
                        </a>
                    </th>
                    <td class="py-4 px-6">
                        <a href="{{ route('cek slip barang keluar', ['id' => $jadwal->nomor_slip]) }}"
                            class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $jadwal->nomor_slip }}
                        </a>
                    </td>
                    <td class="py-4 px-6">
                        {{ $jadwal->nama_penerima }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $jadwal->perusahaan }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $jadwal->alamat }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $jadwal->keterangan }}
                    </td>

                    <td class="py-4 px-6">
                        {{ $jadwal->jarak }} Km
                    </td>
                    <td class="py-4 px-6">
                        {{ $jadwal->estimasi }} Menit
                    </td>

                    <td>
                        {{ $jadwal->tanggal_berangkat }}
                    </td>
                    @if ($jadwal->status == 'berangkat' || $jadwal->status == 'Berangkat')
                        <td class=" bg-green-700 text-white text-center">
                            {{ $jadwal->status }}
                        </td>
                    @else
                        <td class=" bg-blue-400 text-white text-center">
                            {{ $jadwal->status }}
                        </td>
                    @endif


                    {{-- <td class="py-4 px-6">
                        <a type="button" href="{{ route('edit data jadwal', ['id' => $jadwal->nomor_pengiriman]) }}"
                            class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-7 py-2.5 my-1  dark:focus:ring-yellow-900">Edit</a>
                        <a type="button" href="{{ route('hapus data jadwal', ['id' => $jadwal->nomor_pengiriman]) }}"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 my-1  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                            onclick="return confirm('Yakin ingin menghapusnya ?')">Hapus</a>

                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
