@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white">Tambah Barang Keluar</h2>

    <form method="POST">
        @csrf
        <div class="mb-6 mt-6">
            <label for="nomor_barang_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Barang Keluar</label>
            <input type="text" id="nomor_barang_keluar" name="nomor_barang_keluar"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" value="14460042" readonly>
        </div>
        <div class="mb-6">
            <label for="kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                SIPB</label>
            <select id="nomor_sipb" name="nomor_sipb"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>pilih nomor sipb</option>
                @foreach ( DB::table('sipb')->get() as $sipb )
                <option value="{{ $sipb->nomor_sipb }}">{{ $sipb->nomor_sipb }}</option>
                @endforeach

            </select>

        </div>


        <div class="mb-6">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>

            <textarea name="keterangan" id="keterangan" cols="20" rows="2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan keterangan"></textarea>
        </div>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-6" id="table1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        No.
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nomor Material
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Banyaknya
                    </th>

                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row"
                        class="nomor_urut py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        1
                    </td>
                    <td scope="row"
                        class="nomor_material py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                    </td>
                    <td scope="row"
                        class="jumlah py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    </td>
                </tr>

            </tbody>
        </table>

        </form>
        <div class="mb-6">
            <button type="submit"
            id="btn-submit"
                class="block w-full p-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah Barang Keluar</button>

        </div>
@endsection
