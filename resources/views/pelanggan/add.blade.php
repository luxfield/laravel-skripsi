@extends('component.app')
@section('section')
<h2 class="text-4xl font-extrabold dark:text-white">Tambah Pelanggan</h2>
<form>
    <div class="mb-6 mt-6">
      <label for="kd_pengiriman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pelanggan</label>
      <input type="text" id="kd_pengiriman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="kode pelanggan" required>
    </div>
    <div class="mb-6">
      <label for="berat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pelanggan</label>
      <input type="number" id="berat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan berat" required>
    </div>
    <div class="mb-6">
      <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Pelanggan</label>
      <input type="number" id="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan jumlah" required>
    </div>
    <div class="mb-6">
      <label for="kota_asal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telepon</label>
      <input type="text" id="kota_asal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan kota asal" required>
    </div>
    <div class="mb-6">
      <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
      <input type="address" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="masukkan alamat" required>
    </div>

    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  </form>
@endsection
