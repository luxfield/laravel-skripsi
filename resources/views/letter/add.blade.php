@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white">Tambah SIPB</h2>
    <form method="POST" enctype="multipart/form-data">
        @csrf
        {{-- <div class="mb-6 mt-6">
            <label for="nomor_sipb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor SIPB</label>
            <input type="text" id="nomor_sipb" name="nomor_sipb"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" value="{{ $tgl . $id }}" readonly>
        </div> --}}
        <div class="mb-6">
            <label for="id_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nomor
                pelanggan</label>
            <select id="id_pelanggan" name="id_pelanggan" required data-placeholder="pilih nomor pelanggan"
                data-allow-clear="true"
                class="w-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option></option>

                @foreach (DB::table('pelanggan')->get() as $pelanggan)
                    <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->id_pelanggan }} -
                        {{ $pelanggan->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="nama_penerima" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Penerima</label>
            <input type="text" name="nama_penerima" id="nama_penerima"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <div class="mb-6">
            <label for="Alamat perusahaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                perusahaan</label>
            <textarea name="alamat_perusahaan" id="alamat_perusahaan" cols="20" rows="2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan Alamat perusahaan"></textarea>
        </div>
        <div class="mb-6">
            <label for="tanggal_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                pengiriman</label>

            <input name="tanggal_terbit" id="tanggal_terbit" type="datetime-local" value="{{ date('Y-m-d\TH:i:s') }}"
                min="{{ date('Y-m-d\TH:i:s') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan keterangan" required>
        </div>
        <div class="mb-6 mt-6">
            <label for="kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                kendaraan yang tersedia</label>
            <select id="kendaraan" name="nomor_kendaraan" data-placeholder="pilih nomor kendaraan" required
                class="w-100 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option></option>

                @foreach ($data_kurir as $kurir)
                    @if ($kurir->status == 'Tersedia')
                        <option value="{{ $kurir->nomor_kendaraan }}">{{ $kurir->nomor_kendaraan }} (Max :
                            {{ $kurir->max_muatan }} Ton)</option>
                    @endif
                @endforeach

            </select>
        </div>



        <div class="mb-6">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>

            <textarea name="keterangan" id="keterangan" cols="20" rows="2"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan keterangan" required></textarea>
        </div>
        {{-- <div class="mb-6">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file</label>
        <input name="file"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
             type="file">
        </div> --}}
        {{-- <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-6" id="table1">
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
                    <td  scope="row" id=""
                        class=" py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <input type="text" name="nomor_material" id="nomor_material_1" class="nomor_material py-4 px-6">
                    </td>
                    <td scope="row" id="nama_material"
                        class="nama_material py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                    </td>
                    <td contenteditable="true" scope="row"
                        class="jumlah py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                    </td>

                    <td class="px-6">
                        <a
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                            id="btn-hapus" data-row="baris1">Hapus</a>
                    </td>
                </tr>


            </tbody>
        </table> --}}

        <input type='button' value='Tambah Material' id='addRow'
            class="mb-10 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg block w-full p-2.5 text-sm sm:w-auto text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 " id="tableId">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Nomor Material</th>
                    <th scope="col" class="py-3 px-6">Nama Material</th>
                    <th scope="col" class="py-3 px-6">Jumlah</th>
                    <th scope="col" class="py-3 px-6" colspan="2">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <tr id="row1" class='tr_select bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                    <td class=" font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="form-group">
                            <select data-placeholder="pilih/cari nomor material" data-allow-clear="true" class="select2 p-2"
                                name="nomor_material[]" style="width: 100%;">
                                <option></option>
                            </select>
                    </td>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="form-group">
                            <select data-placeholder="pilih/cari nama material" data-allow-clear="true" class="select3 p-2"
                                name="nama_material[]" style="width: 100%;">
                                <option></option>
                            </select>
                    </td>
                    <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <input type='number' name="jumlah[]" id="qty1"
                            class='qty bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'>
                    </td>
                    <td>
                        <span class="total" hidden></span>
                    </td>
                    <td>
                        <a type="button"
                            class="deleteRow text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Hapus
                            material</a>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot >
                <tr class="mt-5 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <td colspan="2">Beban Muatan</td>
                  <td><span id="grandTotal">0 Ton</span></td>
                </tr>
              </tfoot>
        </table>

        <br>
        {{--
        <div class="mb-6">
            <a type="button"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                id="btn-tambah">Tambah Material</a>
            </div> --}}
        <div class="mb-6">
            {{-- <button type="submit" id="btn-submit"
                    class=" text-white p-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg block w-full p-2.5 text-sm sm:w-auto text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> --}}
            <button type="submit"
                class="w-full h-12 px-6 text-indigo-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800">Submit
            </button>
        </div>
    </form>
@endsection
