@extends('component.app')
@section('section')
    <section>
        {{-- <h2 class="text-3xl font-extrabold dark:text-white text-center">SLIP {{ $data_slip[0]->nomor_slip }}</h2> --}}
        <div class="flex">
            <div class="ml-auto">
                <button id="print-btn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Print
                    Surat Jalan</button>
            </div>
        </div>
        <div id="print-slip">
            <img src="/img/logo-full.jpeg" alt="" class="w-full h-1/4 object-cover object-center">
            <hr class="bg-black">
            <div class="mt-10">
                <b class="text-center">
                    <p class=" h3">Surat Keterangan Jalan</p>
                    <p>Nomor Keterangan : {{ $data_slip[0]->nomor_slip }}</p>
                </b>
            </div>
            <div class="grid grid-cols-2 mb-4 mt-8">
                <div>
                    <p>Nama Perusahaan : {{ $data_pelanggan[0]->nama_perusahaan }}</p>
                    <p>Alamat : {{ $data_slip[0]->alamat }}</p>
                    <p>Keterangan : {{ $data_sipb[0]->keterangan }}</p>

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
                            <td scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                1
                            </td>
                            <td class="py-4 px-6">
                                POLE;STEEL;20kV;CIRCL;11m;200daN;;
                            </td>

                            <td class="py-4 px-6">
                                {{ $material->nomor_material }}
                            </td>
                            <td class="py-4 px-6">
                                BTG
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
            <div class="grid grid-cols-3 mb-5">
                <div class="p4"></div>
                <div class="p4"></div>
                <div class="p4 mt-5 ml-4">
                    <p>Dibuat di : Jakarta Timur</p>
                    <p>Pada tanggal : {{ $data_slip[0]->tanggal }}</p>
                </div>

            </div>

            <div class="grid grid-cols-3">
                <div class="p-4 text-center">
                    <p>Pengawas/Pembawa/Penerima Barang</p>
                </div>
                <div class="p-4 text-center">
                    <p>Disetujui oleh,</p>
                    <p>Staff Gudang</p>
                </div>
                <div class="p-4">
                    <p>Dikeluarkan Oleh :</p>
                    <p>SPV Inventori & Penanggung jawab Material</p>
                </div>
                <div class="p-4 grid-row-2">
                    <div class="grid place-items-center pb-20 mt-2.5">

                    </div>
                    <p class="text-center mt-4">{{ $data_sipb[0]->nama_penerima }}</p>
                </div>
                <div class="p-4 grid-row-2 text-center">
                    <div class="grid place-items-center">
                        {!! QrCode::generate('Maulana Ilham Saputra') !!}
                    </div>
                    <p class="mt-2">Maulana Ilham Saputra</p>
                </div>
                <div class="p-4 grid-row-2 text-center">
                    <div class="grid place-items-center">
                        {!! QrCode::generate('Miftah Firdos') !!}
                    </div>
                    <p class="mt-2">Miftah Firdos</p>
                </div>
            </div>

        </div>
    </section>
@endsection
