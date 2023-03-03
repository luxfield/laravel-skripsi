@extends('component.main')
@section('body')
    <section class="my-10 mx-10">
        <h2 class="text-3xl font-extrabold dark:text-white text-center">SLIP {{ $data_slip[0]->nomor_slip }}</h2>
        <div class="grid grid-cols-2 my-4">
            <div>
                <p>Nomor SLIP : {{ $data_slip[0]->nomor_slip }}</p>
                <p>Alamat : {{ $data_slip[0]->alamat }}</p>
                <p>Keterangan : {{ $data_slip[0]->keterangan }}</p>

            </div>
            <div>Tanggal keluar : {{ $data_slip[0]->tanggal }}</div>

        </div>
        <div class="border-solid border-2 border-blue-600 px-2 py-2 rounded-md">


            <h2 class="text-3xl font-extrabold dark:text-white text-center">SIPB {{ $data_sipb[0]->nomor_sipb }}</h2>
            <div class="grid grid-cols-2 my-4">
                <div>
                    <p>Nomor SIPB : {{ $data_sipb[0]->nomor_sipb }}</p>
                    <p>Nomor Kendaraan : {{ $data_sipb[0]->nomor_kendaraan }}</p>
                    <p>Nama Gudang : {{ $data_sipb[0]->nama_gudang }}</p>

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
            <table class="text-sm text-left text-gray-500 dark:text-gray-400">
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
                                {{ $material->nama_material }}
                            </td>

                            <td class="py-4 px-6">
                                {{ $material->nomor_material }}
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
            <div class="grid grid-cols-2 mt-10 text-center">
                <div class="text-center">

                </div>
                <div>
                    <p>Dikeluarkan oleh,</p>
                    <p>SPV Inventori & Penanggung jawab Material</p>
                    <div class="grid place-items-center my-4">
                        {!! QrCode::generate('Miftah Firdos') !!}
                    </div>
                    <p>Miftah Firdos</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 my-5 text-center">
            <div class="text-center">

            </div>
            <div>
                <p>Dikonfirmasi oleh,</p>
                <p>Staff Gudang</p>
                <div class="grid place-items-center my-4">
                    {!! QrCode::generate('Miftah Firdos') !!}
                </div>
                <p>Maulana ilham saputra</p>
            </div>
        </div>
    </section>

@endsection
