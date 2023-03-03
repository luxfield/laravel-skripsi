@extends('component.app')
@section('section')

<div class="overflow-y-auto relative">
    <h2 class="text-4xl mb-5 font-extrabold dark:text-white">Penjadwalan Pengiriman Barang</h2>
    <table class=" text-sm text-left text-gray-500 dark:text-gray-400" id="tabelPenjadwalan">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Nomor Pengiriman
                </th>
                <th scope="col" class="py-3 px-6">
                    Pekerjaan
                </th>
                <th scope="col" class="py-3 px-6">
                    Alamat
                </th>
                <th scope="col" class="py-3 px-6">
                    Jarak Tempuh
                </th>
                <th scope="col" class="py-3 px-6">
                    Estimasi
                </th>
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    Tanggal Berangkat
                </th>


            </tr>
        </thead>
        <tbody>
            @foreach ($data_jadwal as $key => $jadwal)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ ++$key }}
                </th>
                <td class="py-4 px-6">
                    <a href="{{ route('detail data jadwal',['id' => $jadwal->nomor_pengiriman]) }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">
                        {{ $jadwal->nomor_pengiriman }}
                    </a>
                </td>
                <td class="py-4 px-6">
                    {{ $jadwal->keterangan }}
                </td>
                <td class="py-4 px-6">
                    {{ $jadwal->alamat }}
                </td>

                <td class="py-4 px-6">
                    {{ $jadwal->jarak }} Km
                </td>
                <td class="py-4 px-6">
                    {{ $jadwal->estimasi }} Menit
                </td>
                @if ($jadwal->status == 'Selesai')

                <td class="py-4 px-6 bg-blue-700 text-white text-center">
                    {{ $jadwal->status }}
                </td>
                @else
                <td class="py-4 px-6 bg-green-700 text-white text-center">
                    {{ $jadwal->status }}
                </td>
                @endif
                <td>
                    {{ $jadwal->tanggal_berangkat }}
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
