@extends('component.app')
@section('section')
    <section>
        <h2 class="text-3xl font-extrabold dark:text-white mt-2">Detail SIPB</h2>
        <form method="POST">
            @csrf


            <div class="mb-6 mt-6">
                <label for="nama_pelanggan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    pelanggan</label>
                <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required value="{{ $data_pelanggan[0]->nama_perusahaan }}" readonly>
            </div>
            <div class="mb-6 mt-6">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                    pelanggan</label>
                <input type="text" id="alamat" name="alamat"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required value="{{ $data_pelanggan[0]->alamat }}" readonly>
            </div>

            <div class="mb-6">
                <label for="keterangan"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                <textarea name="keterangan" id="keterangan" cols="20" rows="2"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Masukkan keterangan"></textarea>
            </div>
            {{-- <div class="mb-6">
                <label for="lampiran"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lampiran</label>
                <a href="{{ asset('pdf/'.$data_sipb[0]->file) }}"> {{ $data_sipb[0]->file }}</a>
            </div> --}}
            <input type="hidden" name="nomor_sipb" value="{{ $data_sipb[0]->nomor_sipb }}">
            <div class="border-solid border-2 border-blue-600 px-2 py-2 rounded-md">


                <h2 class="text-3xl font-extrabold dark:text-white text-center">SIPB {{ $data_sipb[0]->nomor_sipb }}</h2>
                <div class="grid grid-cols-2 my-4">
                    <div>
                        <p>Nomor SIPB : {{ $data_sipb[0]->nomor_sipb }}</p>
                        <p>Nomor Kendaraan : {{ $data_sipb[0]->nomor_kendaraan }}</p>
                        <p>Nama Gudang : {{ $data_sipb[0]->nama_gudang }}</p>
                        <p>Nama Pelanggan : {{ $data_pelanggan[0]->nama_perusahaan }}</p>

                    </div>
                    <div>
                        <p>
                            Tanggal Terbit : {{ $data_sipb[0]->tanggal_terbit }}
                        </p>
                        <p>
                            Pekerjaan : {{ $data_sipb[0]->keterangan }}
                        </p>
                    </div>

                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                No.
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nama Barang / Material (Ditulis Selengkap-lengkapnya)
                            </th>

                            <th scope="col" class="py-3 px-6">
                                Nomor Material
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Satuan
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Banyaknya
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
                                <td class="py-4 px-6">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="grid grid-cols-2 mt-20 text-center">
                    <div class="text-center">

                    </div>
                    <div>
                        <p>Dikeluarkan oleh,</p>
                        <p>Staff Gudang</p>
                        <div class="grid place-items-center my-4">
                            {!! QrCode::generate('Miftah Firdos') !!}
                        </div>
                        <p>Miftah Firdos</p>
                    </div>
                </div>
                --}}
            </div>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <button type="submit" id="kd_pengiriman" name="status" value="setujui"
                        class="focus:outline-none text-white my-5 w-full bg-green-400 hover:bg-green-500 focus:ring-4 text-center focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:focus:ring-yellow-900">Setujui
                        Surat Pengeluaran Barang </button>
                </div>
                <div>
                    <button type="submit" id="kd_pengiriman" name="status" value="tolak"
                        class="focus:outline-none text-white my-5 w-full bg-red-400 hover:bg-red-500 focus:ring-4 text-center focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:focus:ring-yellow-900">Tolak
                        Surat Pengeluaran Barang </button>
                </div>

            </div>
        </form>
    </section>
@endsection
