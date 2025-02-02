@extends('layouts.app')

@section('title', 'My Course')

@section('content')


    @if ($courses->count() > 0)
        <main class="h-full overflow-y-auto">

            <div class="container mx-auto">
                <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                    <div class="col-span-8">

                        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                            Kursus Saya
                        </h2>

                        <p class="text-sm text-gray-400">
                            {{ $courses->count() }} Total Kursus
                        </p>
                    </div>

                    <div class="col-span-4 lg:text-right">
                        <div class="relative mt-0 md:mt-6">
                            <x-button.button route='courses.create' viewName='+ Tambah Kursus' />
                        </div>
                    </div>
                </div>
            </div>

            <section class="container px-6 mx-auto mt-5">
                @livewire('admin.search', ['segment' => 'course'])
            </section>

        </main>
    @else
        <div class="flex h-screen">
            <div class="m-auto text-center">
                <img src="{{ asset('/assets/images/empty-illustration.svg') }}" alt="" class="w-48 mx-auto">
                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Anda belum memiliki kursus
                </h2>
                <p class="text-sm text-gray-400">
                    Tampaknya Anda belum menyediakan kursus apa pun. <br>
                    Mari kita buat kursus pertama Anda!
                </p>

                <div class="relative mt-0 md:mt-6">
                    <x-button.button route='courses.create' viewName='+ Tambah Kursus' />
                </div>
            </div>
        </div>
    @endif

@endsection
