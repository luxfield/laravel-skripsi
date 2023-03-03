@extends('component.app')
@section('section')

    <section>
        <h2 class="text-3xl font-extrabold dark:text-white text-center">{{ $data_sipb[0]->nomor_sipb }}</h2>
        <div class="grid grid-cols-2 my-4">
            <div>
                <p>Nomor SIPB : {{ $data_sipb[0]->nomor_sipb }}</p>
                <p>Nama Perusahaan : {{ $pelanggan[0]->nama_perusahaan }}</p>
                <p>Alamat Perusahaan : {{ $pelanggan[0]->alamat }}</p>
                <p>Nama Penerima : {{ $data_sipb[0]->nama_penerima }}</p>
                <p>Nomor Kendaraan : {{ $data_sipb[0]->nomor_kendaraan }}</p>
                <p>Nama Gudang : {{ $data_sipb[0]->nama_gudang }}</p>

            </div>
            <div>Pekerjaan : {{ $data_sipb[0]->keterangan }}</div>

        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" >
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
                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
        <div class="grid grid-cols-2 mt-10 mb-5 text-center">
            <div class="text-center">
                <p>Staff gudang</p>
                <div class="grid place-items-center my-4">
                    {!! QrCode::generate('Miftah Firdos') !!}
                </div>
                <p>Miftah Firdos</p>
            </div>
            <div >
                <p>SPV Inventori & Penanggung jawab Material</p>
                <div class="grid place-items-center my-4">
                    {!! QrCode::generate('Maulana Ilham Saputra') !!}
                </div>
                <p>Maulana Ilham Saputra</p>
            </div>
        </div>
    </section>
@endsection
