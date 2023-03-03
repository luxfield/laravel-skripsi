@extends('component.app')
@section('section')
    <section>
        <h2 class="text-3xl font-extrabold dark:text-white text-center">{{ $data_jadwal[0]->nomor_pengiriman }}</h2>
        <div class="grid grid-cols-2 my-4">
            <div>
                <p>Nomor Jadwal Pengiriman : {{ $data_jadwal[0]->nomor_pengiriman }}</p>
                <p>Nomor Slip : {{ $data_jadwal[0]->nomor_slip }}</p>
                <p>Nomor SIPB : {{ $data_sipb[0]->nomor_sipb }}</p>

                <p>Nomor Kendaraan : {{ $data_sipb[0]->nomor_kendaraan }}</p>
                <p>Nama Gudang : {{ $data_sipb[0]->nama_gudang }}</p>

            </div>
            <div>
                <p>Tanggal berangkat : {{ $data_jadwal[0]->tanggal_berangkat }}</p>
                <p>Nama Perusahaan : {{ $data_pelanggan[0]->nama_perusahaan }}</p>
                <p>Alamat : {{ $data_pelanggan[0]->alamat }}</p>
                <p>Nama Penerima : {{ $data_sipb[0]->nama_penerima }}</p>
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
                @foreach ($data_material as $material)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            1
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
        <hr>
        @if ($data_jadwal[0]->status == 'selesai')
        @else
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="p-4 my-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <span class="font-medium">Informasi !</span> Lakukan unggah berkas jika pengiriman telah selesai.
                </div>
                <div class="mt-4">

                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="berkas">Unggah
                        Berkas</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="berkas_terima" id="berkas" name="berkas" type="file"
                        accept=".pdf,.png,.jpg,.jpeg" maxlength="1024" required aria-required="harap unggah berkas">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="berkas_terima">
                        PNG, JPG or PDF (MAX. 800x400px or 5MB).</p>
                </div>

                <div class="form-group my-4">
                    {{-- <label for="checkbox-input" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pilih</label> --}}
                    <div class="form-check">
                        <input type="checkbox" id="checkbox-input" class="form-check-input">
                        <label for="checkbox-input" class="form-check-label">Kami dengan ini
                            menegaskan bahwa berkas yang diunggah ini sah dan telah ditandatangani oleh penerima dengan
                            tangan
                            sendiri.</label>
                    </div>
                </div>
                <button type="submit" id="submit-button"
                    class="text-white  bg-blue-400 cursor-not-allowed hover:bg-blue-500 focus:ring-4 focus:ring-blue-400 font-medium rounded-lg text-sm w-full py-2.5 mr-2 mb-4 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none dark:focus:ring-blue-800"
                    disabled>Pengiriman Selesai</button>
            </form>
        @endif
    </section>
@endsection
