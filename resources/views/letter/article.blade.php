<div class="overflow-y-auto relative w-full">
    <h2 class="text-4xl font-extrabold dark:text-white">Surat Ijin Pengeluaran Barang (SIPB)</h2>
    <a type="button"
        class="text-white mt-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        href="{{ route('tambah-surat-keluar') }}"> Tambah SIPB</a>
    <form>
        <div class="relative mb-3">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-5" id="tableInputSIPB">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th scope="col" class="py-3 px-6">
                    Nomor SIPB
                </th>
                <th scope="col" class="py-3 px-6">
                    Nama Perusahaan
                </th>
                <th scope="col" class="py-3 px-6">
                    Nama Penerima
                </th>
                <th scope="col" class="py-3 px-6">
                    No. Kendaraan
                </th>
                <th scope="col" class="py-3 px-6">
                    Gudang
                </th>
                <th scope="col" class="py-3 px-6">
                    Pekerjaan
                </th>
                <th scope="col" class="py-3 px-6">
                    status
                </th>
                <th scope="col" class="py-3 px-6">
                    Tanggal terbit
                </th>
                {{-- <th scope="col" class="py-3 px-6">
                    Detail barang
                </th> --}}
                <th scope="col" class="py-3 px-6">
                    Aksi
                </th>

            </tr>
        </thead>
        <tbody>
            @if (count($data_sipb) == 0)
            @else
                @foreach ($data_sipb as $index => $sipb)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row"
                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('detail-surat-keluar', ['id' => $sipb->nomor_sipb]) }}" type="button"
                                class="underline text-blue-500 hover:text-blue-700">
                                {{ $sipb->nomor_sipb }}
                            </a>
                        </td>
                        <td class="py-4 px-6">
                            {{ $pelanggan[0]->nama_perusahaan }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sipb->nama_penerima }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sipb->nomor_kendaraan }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sipb->nama_gudang }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $sipb->keterangan }}
                        </td>
                        @if ($sipb->status == 'setujui')
                            <td class="py-4 px-6 bg-green-700 text-white text-center">
                                {{ $sipb->status }} oleh Supervisor Logistik
                            </td>
                        @elseif ($sipb->status == 'belum disetujui')
                            <td class="py-4 px-6 bg-yellow-500 text-white text-center">
                                {{ $sipb->status }} oleh Supervisor Logistik
                            </td>
                        @else
                            <td class="py-4 px-6 bg-red-700 text-white text-center">
                                {{ $sipb->status }} oleh Supervisor Logistik
                            </td>
                        @endif
                        <td class="py-4 px-6">
                            {{ $sipb->tanggal_terbit }}
                        </td>
                        {{-- <td class="py-4 px-6">
                        <a href="{{ route('detail-surat-keluar', ['id' => $sipb->nomor_sipb]) }}" type="button"
                            class="focus:outline-none text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 text-center focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:focus:ring-yellow-900">Detail
                            Barang</a>
                    </td> --}}
                        <td class="py-4 px-6">
                            @if ($sipb->status == 'setujui')
                            @elseif ($sipb->status == 'tolak')
                                <a href="{{ route('hapus-surat-keluar', ['id' => $sipb->nomor_sipb]) }}" type="button"
                                    onclick="return confirm('Apakah anda yakin ingin menghapusnya ?');"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 my-1  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</a>
                            @else
                                <a href="{{ route('edit surat keluar', ['id' => $sipb->nomor_sipb]) }}" type="button"
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-7 py-2.5 my-1  dark:focus:ring-yellow-900">Edit</a>
                                <a href="{{ route('hapus-surat-keluar', ['id' => $sipb->nomor_sipb]) }}" type="button"
                                    onclick="return confirm('Apakah anda yakin ingin menghapusnya ?');"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 my-1  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            @endif
        </tbody>
    </table>
</div>
