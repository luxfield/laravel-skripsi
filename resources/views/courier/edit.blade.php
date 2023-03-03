@extends('component.app')
@section('section')
    <form action="{{ route('kurir.update', $data_kurir[0]->nomor_kendaraan) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-6">
            <label for="nomor_kendaraan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Kendaraan</label>
            <input value="{{ $data_kurir[0]->nomor_kendaraan }}" name="nomor_kendaraan" id="nomor_kendaraan" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" readonly>
        </div>
        <div class="mb-6">
            <label for="nama_pengemudi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengemudi</label>
            <input value="{{ $data_kurir[0]->nama_pengemudi }}" name="nama_pengemudi" id="nama_pengemudi" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        <div class="mb-6">
            <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Pengemudi</label>
            <input value="{{ $data_kurir[0]->alamat }}" name="alamat" id="alamat" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        <div class="mb-6">
            <label for="no_telepon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
            <input value="{{ $data_kurir[0]->no_telepon }}" name="no_telepon" id="no_telepon" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        <div class="mb-6">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <input value="{{ $data_kurir[0]->status }}" name="status" id="status" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
        </div>
        <div class="mb-10">
            <button class="block w-full focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900" type="submit">Ubah Data</button>
        </div>
    </form>
@endsection
