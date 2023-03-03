@extends('component.app')
@section('section')

<section>
    <h2 class="text-3xl font-extrabold dark:text-white text-center">SIPB {{ $data_sipb[0]->nomor_sipb }}</h2>
    <div class="grid grid-cols-2 my-4">
        <div>
            <p>Nomor SIPB : {{ $data_sipb[0]->nomor_sipb }}</p>
            <p>Nomor Kendaraan : {{ $data_sipb[0]->nomor_kendaraan }}</p>
            <p>Nama Gudang : {{ $data_sipb[0]->nama_gudang }}</p>

        </div>
        <div>Pekerjaan : {{ $data_sipb[0]->keterangan }}</div>

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
    <div class="grid grid-cols-2 mt-20 text-center">
        <div class="text-center">
            <p>Pengawas/Pembawa/Penerima Barang</p>

        </div>
        <div >
            <p>Dikeluarkan Oleh,</p>
            <p>SPV Inventori & Penanggung jawab Material</p>
            <div class="grid place-items-center my-4">
                {!! QrCode::generate('Miftah Firdos') !!}
            </div>
            <p>Miftah Firdos</p>
        </div>
    </div>
</section>
@endsection
