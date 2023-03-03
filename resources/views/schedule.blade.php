@extends('component.app')
@section('section')

    <section>
        <div class="grid grid-cols-2">
            {{-- <div>
                <a type="button" class="text-white text-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" href="{{ route('tambah jadwal') }}"> Tambah jadwal pengiriman</a>

            </div> --}}
            {{-- <div class="justify-self-end place-self-end">
                <a type="button" class="text-white text-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800" href="{{ route('sjf data jadwal') }}"> Shortest Job First</a>

            </div> --}}
          </div>
        @include('schedule.article')
    </section>
@endsection
