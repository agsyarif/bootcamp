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
                <main class="p-4 lg:col-span-12 md:col-span-12 md:pt-0 flex gap-4">

                    <div class="p-6 mt-8 bg-white rounded-xl w-full">

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
                                    <div c lass="img flex  mob:block">
                                        <img class="rounded-md mob:w-auto" width="150px"
                                            src="{{ asset('images/course/thumbnail/' . $c->image) }}" alt="">
                                        <div class="sm:m-1 mob:m-10-0">
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

                    <div class="p-6 mt-8 bg-white rounded-xl w-1/2">

                        <div>
                            <h2 class="mb-1 text-xl font-semibold">
                                Rekapitulasi Nilai
                            </h2>

                            <p class="text-sm text-gray-400">
                                {{ $nilai->count() ?? '' }} kuis
                            </p>
                        </div>

                        <div class="">

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <tr>
                                    <th colspan="3" scope="col" class="py-3 px-6">
                                        Jumlah kuis :
                                    </th>
                                    <th colspan="2" scope="col" class="py-3 px-6">
                                        {{ $nilai->count() }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="3" scope="col" class="py-3 px-6">
                                        Rata - Rata Nilai :
                                    </th>
                                    <th colspan="2" scope="col" class="py-3 px-6">
                                        {{ $persentase_nilai }}
                                    </th>
                                </tr>
                            </table>
                            <div style="height: 2px; width: 100%; background-color: rgb(27, 58, 78)" class="mt-3 rounded">

                            </div>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            No
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Judul Kuis
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Kelas
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Nilai
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Dikerjakan
                                        </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div wire:loading.block wire:target="search" class="alert alert-warning"
                                                role="alert">
                                                Sedang mencari data...
                                            </div>
                                        </td>
                                    </tr>
                                    <div wire:loading.remove wire:target="search">
                                        @forelse ($nilai as $key => $value)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <td class="py-4 px-6">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $value->exam->title ?? '-' }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $value->akses_course->course->name ?? '-' }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 @if ($value->score <= 50) text-red-400 @elseif($value->score >= 50) text-green-400 @endif">
                                                    {{ $value->score ?? '-' }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}
                                                </td>
                                                {{-- <th scope="row"
                                                        class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">

                                                        @if ($men->user->profile_photo_path != null)
                                                            <img class="w-10 h-10 rounded-full"
                                                                src="{{ url($men->user->profile_photo_path) }}"
                                                                alt="thumbnail" loading="lazy" />
                                                        @else
                                                            <img class="w-10 h-10 rounded-full"
                                                                src="{{ url('https://randomuser.me/api/portraits/men/3.jpg') }}"
                                                                alt="" loading="lazy" />
                                                        @endif

                                                        <div class="ml-2">
                                                            <div class="text-base font-semibold">
                                                                {{ $men->user->name ?? '-' }}</div>
                                                            <div class="font-normal text-gray-500">
                                                                {{ $men->user->email ?? '-' }}
                                                            </div>
                                                        </div>
                                                    </th> --}}
                                                {{-- <td class="py-4 px-6">
                                                        {{ $men->course_caregory->name ?? '-' }}
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        {{ $men->price ?? '-' }}
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        <div class="flex items-center">
                                                            @if ($men->is_published == 0)
                                                                <div class="h-2.5 w-2.5 rounded-full bg-red-400 mr-2"></div>
                                                                <span class="text-red-400">
                                                                    Non Active
                                                                </span>
                                                            @elseif ($men->is_published == 1)
                                                                <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2">
                                                                </div>

                                                                <span class="text-green-400">
                                                                    Active
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        {{ \Carbon\Carbon::parse($men->created_at)->diffForHumans() }}
                                                    </td>
                                                    <td class="pb-3 px-6">
                                                        <div class="flex items-center gap-2">
                                                            <a href="{{ route('admin.course.edit', $men['id']) }}"
                                                                class="py-2 mt-2 text-serv-yellow hover:text-gray-800">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </a>
                                                            <form action="{{ route('admin.course.destroy', $men->id) }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="py-2 mt-2 text-red-500 hover:text-gray-800"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <i class="fa-regular fa-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center pt-4">
                                                    <p class="text-gray-500">
                                                        Data Tidak Ditemukan
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </div>
                                </tbody>
                            </table>
                            {{-- @forelse ($course as $key => $c)
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
                            @endforelse --}}
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
