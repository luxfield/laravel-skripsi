@extends('component.app')
@section('section')
<div class="grid grid-cols-2">
    <div>
        <a type="button" class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route('tambah jadwal') }}"> Tambah jadwal pengiriman</a>

    </div>
    <div class="justify-self-end place-self-end">
        <a type="button" class="text-white text-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800" href="{{ route('tampil jadwal') }}">Kembali ke semula</a>

    </div>
  </div>
<div class="overflow-y-auto relative">
    <table class=" text-sm text-left text-gray-500 dark:text-gray-400">
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
                    Tanggal Berangkat
                </th>

                <th scope="col" class="py-3 px-6">
                    Aksi
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

                <td>
                    {{ $jadwal->tanggal_berangkat }}
                </td>

                <td class="py-4 px-6">
                    <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-7 py-2.5 my-1  dark:focus:ring-yellow-900">Edit</button>
                    <a type="button" href="{{ route('hapus data jadwal',['id' => $jadwal->nomor_pengiriman]) }}"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 my-1  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        >Hapus</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
