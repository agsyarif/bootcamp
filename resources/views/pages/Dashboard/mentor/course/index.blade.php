@extends('layouts.app')

@section('title', 'My Course')

@section('content')


    @if ($courses > 0)
        <main class="h-full overflow-y-auto">

            <div class="container mx-auto">
                <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                    <div class="col-span-8">

                        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                            My course
                        </h2>

                        <p class="text-sm text-gray-400">
                            {{ $courses }} Total course
                        </p>
                    </div>

                    <div class="col-span-4 lg:text-right">
                        <div class="relative mt-0 md:mt-6">
                            <a href="{{ route('mentor.course.create') }}"
                                class="inline-block px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                                + Add Course
                            </a>
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
                    There is No Requests Yet
                </h2>
                <p class="text-sm text-gray-400">
                    It seems that you haven’t provided any Course. <br>
                    Let’s create your first Course!
                </p>

                <div class="relative mt-0 md:mt-6">
                    <a href="{{ route('mentor.course.create') }}"
                        class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                        + Add course
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection
