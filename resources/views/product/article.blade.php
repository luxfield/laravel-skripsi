<div class="overflow-y-auto relative w-full">
    <h2 class="text-4xl font-extrabold dark:text-white">Surat Jalan</h2>
    {{-- <div class="mt-2">
        <a type="button" class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href=""> Tambah Surat Jalan</a>
    </div> --}}
    <form>
        <div class="relative my-3">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="search" id="search"
                class="font-medium block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-center"
                placeholder="Masukkan nomor material" required>
            <button type="submit"
                class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 text-center">Cari</button>
        </div>
    </form>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Nomor Surat Jalan
                </th>
                <th scope="col" class="py-3 px-6">
                    Nomor SIPB
                </th>
                <th scope="col" class="py-3 px-6">
                    Tanggal Keluar
                </th>
                <th scope="col" class="py-3 px-6">
                    Alamat
                </th>
                <th scope="col" class="py-3 px-6">
                    Keterangan
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($data_barang as $key => $barang)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ ++$key }}
                    </th>
                    <td class="py-4 px-6">
                        <a href="{{ route('cek slip barang keluar',['id' => $barang->nomor_slip]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $barang->nomor_slip }}
                        </a>

                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('cek sipb barang keluar',['id' => $barang->nomor_sipb]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                            {{ $barang->nomor_sipb }}
                        </a>
                    </td>
                    <td class="py-4 px-6">
                        {{ $barang->tanggal }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $barang->alamat }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $barang->keterangan }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
