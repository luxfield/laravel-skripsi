@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white">Tambah jadwal pengiriman</h2>
    <form method="post">
        @csrf

        <div class="mb-6">
            <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Slip</label>
            <select name="nomor_slip" id="nomor_slip"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Masukkan nomor slip</option>
                @foreach ($data_barang_keluar as $barang_keluar)
                    @if (DB::table('jadwal_pengiriman')->where('nomor_slip', '=', $barang_keluar->nomor_slip)->count() == 1)
                    @else
                        <option value="{{ $barang_keluar->nomor_slip }}">{{ $barang_keluar->nomor_slip }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="tanggal_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                berangkat</label>
            <input type="date" name="tanggal_berangkat" id="tanggal_berangkat" value="{{ date('Y-m-d') }}"
                min="{{ date('Y-m-d') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input readonly type="text" id="alamat" name="alamat" placeholder="masukkan alamat"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="nomor_kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                kendaraan</label>
            <input readonly type="text" id="nomor_kendaraan" name="nomor_kendaraan"
                placeholder="masukkan nomor kendaraan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                Pekerjaan</label>
            <textarea readonly type="text" id="keterangan" name="keterangan" placeholder="masukkan alamat"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
      </textarea>
        </div>

        <input type="hidden" name="nomor_sipb" id="nomor_sipb">
        <div class="relative overflow-x-auto">
            <table class=" text-sm text-left text-gray-500 dark:text-gray-400 w-full">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            No.
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nomor Material
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Nama Material
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Satuan
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Jumlah
                        </th>

                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full my-4 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah
            jadwal pengiriman</button>
    </form>
@endsection
