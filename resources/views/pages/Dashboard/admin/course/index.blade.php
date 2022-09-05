@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Daftar Kelas
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $course->count() ?? '' }} Total Kelas
                    </p>
                </div>

            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">

            {{-- livewire --}}
            @livewire('admin.search', ['segment' => 'kelasAdmin'])

        </section>
    </main>

@endsection
