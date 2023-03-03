@extends('component.app')
@section('section')
    <h2 class="text-4xl font-extrabold dark:text-white mb-6">Edit jadwal pengiriman</h2>
    <form method="post">
        @csrf

        <div class="mb-6">
            <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                Pengiriman</label>
            <input type="text" name="nomor_slip" id="nomor_slip" value="{{ $data_barang_keluar[0]->nomor_pengiriman }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                readonly>

        </div>
        <div class="mb-6">
            <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Slip</label>
            <select name="nomor_slip" id="nomor_slip"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Masukkan nomor slip</option>
                @foreach ($data_slip as $slip)
                    @if ($slip->nomor_slip == $data_barang_keluar[0]->nomor_slip)
                        <option value="{{ $slip->nomor_slip }}" selected>{{ $slip->nomor_slip }}</option>
                    @else
                        <option value="{{ $slip->nomor_slip }}">{{ $slip->nomor_slip }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="tanggal_berangkat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                berangkat</label>
            <input type="date" name="tanggal_berangkat" id="tanggal_berangkat"
                value="{{ $data_barang_keluar[0]->tanggal_berangkat }}" min="{{ $data_barang_keluar[0]->tanggal_berangkat }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
            <input readonly type="text" id="alamat" name="alamat" placeholder="masukkan alamat"
                value="{{ $data_barang_keluar[0]->alamat }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="nomor_kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                kendaraan</label>
            <input readonly type="text" id="nomor_kendaraan" name="nomor_kendaraan"
                placeholder="masukkan nomor kendaraan" value="{{ $data_barang_keluar[0]->nomor_kendaraan }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>
        </div>
        <div class="mb-6">
            <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan
                Pekerjaan</label>
            <textarea readonly type="text" id="keterangan" name="keterangan" placeholder="masukkan alamat"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="masukkan berat" required>{{ $data_barang_keluar[0]->keterangan }}
      </textarea>
        </div>
        <div class="mb-6">
            <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status Pengiriman</label>
            <select name="status" id="status"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Pilih Status Pengiriman</option>
                @foreach ($status_pengiriman as $status)
                    @if ($status == $data_barang_keluar[0]->status)
                        <option value="{{ $status }}" selected>{{ $status }}</option>
                    @else
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <input type="hidden" name="nomor_sipb" id="nomor_sipb" value="{{ $data_barang_keluar[0]->nomor_sipb }}">
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
                        <th scope="col" class="py-3 px-6">
                            Keterangan
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_material as $index => $material)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ ++$index }}
                            </td>
                            <td class="py-4 px-6">

                                {{ $material->nama_material }}
                            </td>

                            <td class="py-4 px-6">
                                {{ $material->kode_material }}
                            </td>
                            <td class="py-4 px-6">

                                {{ $material->satuan }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $material->jumlah }}
                            </td>
                            @switch($material->satuan)
                                @case('SET')
                                    <td class="py-4 px-6">
                                        Pemuatan sekitar 12 Menit~
                                    </td>
                                @break

                                @case('BM')
                                    <td class="py-4 px-6">
                                        Pemuatan sekitar 5 Menit~
                                    </td>
                                @break

                                @case('M')
                                    <td class="py-4 px-6">
                                        Pemuatan sekitar 7 Menit~
                                    </td>
                                @break

                                @case('BTG')
                                    <td class="py-4 px-6">
                                        Pemuatan sekitar 17 Menit~
                                    </td>
                                @break

                                @default
                            @endswitch

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full my-4 px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
            jadwal pengiriman</button>
    </form>
@endsection
