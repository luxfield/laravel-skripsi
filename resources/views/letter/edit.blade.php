@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white">Edit SIPB</h2>
    <form method="POST">
        @csrf
        <div class="mb-6 mt-6">
            <label for="nomor_sipb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor SIPB</label>
            <input type="text" id="nomor_sipb" name="nomor_sipb"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="" value="{{ $data_sipb[0]->nomor_sipb }}" readonly>
        </div>

        <div class="mb-6">
            <label for="id_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nomor
                pelanggan</label>
            <select id="id_pelanggan" name="id_pelanggan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>pilih nomor pelanggan</option>

                @foreach (DB::table('pelanggan')->get() as $pelanggan)
                    @if ($pelanggan->id_pelanggan == $data_sipb[0]->id_pelanggan)
                        <option selected value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->id_pelanggan }} -
                            {{ $pelanggan->nama_perusahaan }}</option>
                    @endif
                    <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->id_pelanggan }} -
                        {{ $pelanggan->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="tanggal_terbit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                terbit</label>

            <input name="tanggal_terbit" id="tanggal_terbit" type="datetime-local" value="{{ date('Y-m-d\TH:i:s') }}"
                min="{{ date('Y-m-d\TH:i:s') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan keterangan" required>
        </div>
        <div class="mb-6 mt-6">
            <label for="kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                kendaraan yang tersedia</label>
            <select id="kendaraan" name="nomor_kendaraan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>pilih nomor kendaraan</option>
                @foreach ($data_kurir as $kurir)
                    @if ($kurir->nomor_kendaraan == $data_sipb[0]->nomor_kendaraan)
                        <option selected value="{{ $kurir->nomor_kendaraan }}">{{ $kurir->nomor_kendaraan }}</option>
                    @else
                    <option value="{{ $kurir->nomor_kendaraan }}">{{ $kurir->nomor_kendaraan }}</option>
                    @endif
                @endforeach

            </select>
        </div>


        <div class="mb-6">
            <label for="nama_gudang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nama
                gudang</label>
            <select id="nama_gudang" name="nama_gudang"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>pilih nama gudang</option>
                <option value="UP3">UP3 Marunda</option>

            </select>
        </div>


        <div class="mb-6">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>

            <textarea name="keterangan" id="keterangan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Masukkan keterangan" required>{{ $data_sipb[0]->keterangan }}
            </textarea>
        </div>



        <input type='button' value='Tambah Material' id='addmore'
            class="mb-10 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg block w-full p-2.5 text-sm sm:w-auto text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 " id="table1">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">Nomor Material</th>
                    <th scope="col" class="py-3 px-6">Nama Material</th>
                    <th scope="col" class="py-3 px-6">Jumlah</th>
                    <th scope="col" class="py-3 px-6">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @if (count($data_item) == 0)
                <tr class='tr_input bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                <td rowspan="4">
                    <div class="w-full">
                        <p class="text-center flex flex-col justify-center items-center">Tidak ada data</p>

                    </div>
                </td>
                </tr>
               @else

                @foreach ($data_item as $index => $barang)
                    <tr class='tr_input bg-white border-b dark:bg-gray-800 dark:border-gray-700'>
                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type='text' name="nomor_material[]"
                                class='username nomor_material bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"'
                                id='username_{{ $index }}' placeholder='Masukkan kode material'
                                value="{{ $barang->nomor_material }}">
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type='text' value="{{ $barang->nama_material }}"
                                class='name bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                                id='name_{{ $index }}' readonly>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type='number' name="jumlah[]"
                                class='age jumlah bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'
                                id='age_{{ $index }}' value="{{ $barang->jumlah }}">
                        </td>

                        <td>
                            <a type="button" onclick="deleteRow(this)"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                id="btn-tambah">Hapus material</a>
                            </div>
                        </td>

                    </tr>
                    @php
                        ++$index;
                    @endphp
                @endforeach
                @endif
            </tbody>
        </table>

        <br>
        {{--
        <div class="mb-6">
            <a type="button"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                id="btn-tambah">Tambah Material</a>
            </div> --}}
            <div class="mb-6">
                <button type="submit"
                

                    class="w-full h-12 px-6 text-indigo-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800">Submit
                </button>
            </div>
    </form>
@endsection
