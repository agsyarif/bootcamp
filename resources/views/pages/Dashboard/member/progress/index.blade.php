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
                <main class="p-4 lg:col-span-12 md:col-span-12 md:pt-0 flex gap-4 mob:block">

                    <div class="p-6 mt-8 bg-white rounded-xl w-full">

                        <div>
                            <h2 class="mb-1 text-xl font-semibold">
                                Kelas Aktif
                            </h2>

                            <p class="text-sm text-gray-400">
                                {{ $aksesCourse->count() ?? '' }} View All
                            </p>
                        </div>

                        <div class="">

                            {{-- {{$aksesCourse}} --}}
                            @foreach ($aksesCourse as $aksesCourse)
                            {{-- =================== --}}
                                <article class="flex items-start space-x-6 pt-4">
                                    <img src="{{ asset('course/thumbnail/' . $aksesCourse->course->image) }}" alt="" width="150" height="150" class="flex-none rounded-md" />
                                    <div class="min-w-0 relative flex-auto">
                                    <h2 class="font-semibold text-slate-900 truncate pr-20">{{ $aksesCourse->course->name }}</h2>
                                    <h2 class="font-normal text-slate-900 truncate pr-20">Aktif mulai : {{ \Carbon\Carbon::parse($aksesCourse->created_at)->isoFormat('dddd, D MMMM Y') }}</h2>
                                    <dl class="mt-2 flex flex-wrap text-sm leading-6 font-medium">
                                        
                                        @foreach ($progress as $item)
                                            @foreach ($item as $key => $value)
                                                @if ($key == $aksesCourse->id)
                                                    <div class="absolute top-5 right-0 flex items-center space-x-1">
                                                        <dt class="text-gray-700">
                                                            <i class="fa-solid fa-film"></i>
                                                        </dt>
                                                        <dd>{{ $value['aksesMaterial'] }}/{{ $value['totalMaterial'] }}</dd>
                                                    </div>
                                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                                        <div class="bg-green900 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: {{ $value['progress'] }}%"> {{ $value['progress'] }} %</div>
                                                    </div>
                                                    {{-- <div class="pt-4">{{ $value['aksesMaterial'] }}/{{ $value['totalMaterial'] }}</div> --}}
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <div class="flex-none w-full font-normal">
                                        <dt class="sr-only">Total Score</dt>
                                        <dd class="text-slate-400">Total Nilai : {{ $aksesCourse->getSumScore() / $aksesCourse->getCountExam() }}</dd>
                                        </div>
                                        <div class="flex gap-2 w-full font-normal">
                                            <dd class="text-slate-400">
                                                <a href="{{route('member.progress.show', $aksesCourse->id)}}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </dd>
                                            <dd class="text-slate-400">
                                                <a href="{{ route('member.course.show', [$aksesCourse->course->id]) }}">
                                                    <i class="fa-solid fa-arrow-right"></i>
                                                    lanjut belajar
                                                </a>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                              </article>
                              
                            {{-- =================== --}}
                            
                                <div style="height: 1px; width: 100%; background-color: rgb(27, 58, 78)"
                                    class="mt-3 rounded-full">
                                </div>
                            
                            @endforeach

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
