@extends('component.main')
@section('body')
    <header>
        @include('component.navbar')
    </header>
    <div class="grid grid-cols-5 gap-3">
        <div>
            @include('component.sidebar')
        </div>
        <div class="col-span-4 mr-4" >
            {{-- <section>
                @include('component.input')
            </section> --}}
            @yield('section')
        </div>
    </div>
    @include('component.script')

@endsection
