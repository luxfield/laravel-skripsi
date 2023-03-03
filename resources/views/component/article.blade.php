<div class="overflow-y-auto relative w-full mb-10">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    No.
                </th>
                <th scope="col" class="py-3 px-6">
                    Nomor Kendaraan
                </th>
                <th scope="col" class="py-3 px-6">
                    Nama Pengemudi
                </th>
                {{-- <th scope="col" class="py-3 px-6">
                    Alamat
                </th>
                <th scope="col" class="py-3 px-6">
                    No Telepon
                </th> --}}
                <th scope="col" class="py-3 px-6">
                    Status
                </th>
                <th scope="col" class="py-3 px-6">
                    aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_kurir as $index => $kurir)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ ++$index }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $kurir->nomor_kendaraan }}
                    </td>
                    <td class="py-4 px-6">
                        {{ $kurir->nama_pengemudi }}
                    </td>
                    {{-- <td class="py-4 px-6">
                    {{ $kurir->alamat }}
                </td>
                <td class="py-4 px-6">
                    {{ $kurir->no_telepon }}
                </td> --}}
                    {{-- <td class="py-4 px-6"> --}}
                    @if ($kurir->status == 'pengiriman')
                        <td class=" bg-red-700 text-white text-center">
                            {{ $kurir->status }}
                        </td>
                    @else
                        <td class=" bg-green-700 text-white text-center">
                            {{ $kurir->status }}
                        </td>
                    @endif
                    <td class="py-4 px-6">
                        <a href="{{ route('kurir.edit', ['kurir' => $kurir->nomor_kendaraan]) }}" type="button"
                            class="focus:outline-none my-1 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-7 py-2.5 mr-2  dark:focus:ring-yellow-900">Edit</a>

                        <form action="{{ route('kurir.destroy', ['kurir' => $kurir->nomor_kendaraan]) }}"
                            method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapusnya ?')" type="submit"
                                class="focus:outline-none my-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hapus</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
