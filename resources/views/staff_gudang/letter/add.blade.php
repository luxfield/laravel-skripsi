@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white">Tambah SIPB</h2>
    <form method="POST">
        @csrf
        <div class="mb-6">
            <label for="kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                kendaraan</label>
            <select id="kendaraan" name="nomor_kendaraan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>pilih nomor kendaraan</option>
                @foreach (DB::table('kurir')->get() as $kurir)
                    <option value="{{ $kurir->nomor_kendaraan }}">{{ $kurir->nomor_kendaraan }}</option>
                @endforeach

            </select>

        </div>
        <div class="mb-6">
            <label for="gudang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gudang</label>
            <select id="gudang" name="nama_gudang"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>pilih nama gudang</option>
                <option value="UP3">UP3 Marunda</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
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
                    <th scope="col" class="py-3 px-6">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td contenteditable="true" scope="row"
                        class="nomor_urut py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        1
                    </td>
                    <td contenteditable="true" scope="row"
                        class="nomor_material py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                    </td>
                    <td contenteditable="true" scope="row"
                        class="jumlah py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                    </td>

                    <td class="px-6">
                        <a class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                            id="btn-hapus" data-row="baris1">Hapus</a>
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="mb-6">
            <a type="button"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                id="btn-tambah">Tambah Material</a>
        </div>
    </form>
    <div class="mb-6">
        <button type="submit" id="btn-submit"
            class="block w-full p-2.5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

    </div>
@endsection
