@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Overviews
                    </h2>

                    <p class="text-sm text-gray-400">
                        Monthly Reports
                    </p>

                </div>

                <div class="col-span-4 text-right">
                    <div @click.away="open = false" class="relative z-10 hidden mt-5 lg:block" x-data="{ open: false }">

                        <button
                            class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left bg-white rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4">

                            @if (auth()->user()->first()->profile_photo_path != null)
                                <img src="{{ asset(auth()->user()->profile_photo_path) }}" alt=""
                                    class="inline ml-3 h-12 w-12 rounded-full">
                            @else
                                <img class="inline ml-3 h-12 w-12 rounded-full"
                                    src="{{ url('https://randomuser.me/api/portraits/men/1.jpg') }}" alt="">
                            @endif

                            Halo, {{ Auth::user()->name }}

                        </button>

                    </div>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">

            <div class="grid gap-5 md:grid-cols-12">
                <main class="p-4 lg:col-span-7 md:col-span-12 md:pt-0">

                    <div class="p-6 mt-8 bg-white rounded-xl">

                        <div>
                            <h2 class="mb-1 text-xl font-semibold">
                                Kelas Aktif
                            </h2>

                            <p class="text-sm text-gray-400">
                                {{ $course->count() ?? '' }} View All
                            </p>
                        </div>

                        <div class="">
                            @forelse ($course as $key => $c)
                                <div class="my-4">
                                    <div class="img flex">
                                        <img class="rounded-md" width="150px"
                                            src="{{ asset('images/course/thumbnail/' . $c->image) }}" alt="">
                                        <div class="mx-4">
                                            <h4>{{ $c->name }}</h4>
                                            <h4>Aktif
                                                mulai :
                                                {{ \Carbon\Carbon::parse($c->created_at)->isoFormat('dddd, D MMMM Y') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <div class="mt-5 w-full bg-gray-200 rounded-full">
                                            <div class="bg-green900 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-l-full"
                                                style="width: {{ $persen }}%"> {{ $persen }}%</div>
                                        </div>
                                        <div class="pt-4">{{ $progress->count() }}/{{ $materi->count() }}</div>
                                    </div>
                                    <div style="height: 2px; width: 100%; background-color: rgb(27, 58, 78)"
                                        class="mt-3 rounded">

                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>

                    </div>

                </main>
            </div>

        </section>
    </main>

    {{-- add script --}}
    @push('after-script')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            var options = {
                chart: {
                    type: 'bar',
                    height: 350,
                    // zoom: {
                    //     enabled: false
                    // }
                    width: '60%'
                },
                series: [{
                    name: 'sales',
                    data: [01, 05, 03, 0]
                }],
                xaxis: {
                    categories: ['Web Programming', 'Design', 'Marketing', 'Mobile Programming'],
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
        </script>
    @endpush
@endsection
