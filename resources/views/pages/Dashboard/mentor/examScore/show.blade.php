@extends('layouts.app')

@section('title', 'My Materi')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Nilai Kuis : <br>{{ optional(optional($score)[0])->akses_course->user->name ?? '' }}
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $score->count() }} Total Kuis
                    </p>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">

                <li class="flex items-center">
                    <a href="{{ route('mentor.course.index') }}" class="text-gray-400">My Course</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="{{ route('mentor.member.show', $score[0]->akses_course->course_id) }}" class="text-gray-400">Member Course</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center">
                    <a href="#" class="font-medium">Nilai Kuis</a>
                </li>

            </ol>
        </nav>

        <section class="container px-6 mx-auto mt-5">

            {{-- @livewire('mentor.search-exam-score', ['course' => $score, 'segment' => 'examScore']) --}}
            {{-- @livewire('mentor.search-member', ['course' => $score, 'segment' => 'examScore']) --}}

            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-lg">
        
        
                        <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">
                            {{-- <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                                <div>
        
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" wire:model.debounce.300ms="search" id="table-search-users" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search of Member">
                                </div>
                            </div> --}}
        
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <thead>
                                            <tr>
                                                <th class="py-4 px-6">No
                                                </th>
                                                <th class="py-4 px-6">Kuis</th>
                                                <th class="py-4 px-6">Kursus Bab</th>
                                                <th class="py-4 px-6">Dikerjakan</th>
                                                <th class="py-4 px-6">Nilai</th>
                                                <th class="py-4 px-6">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
        
                                            <tr>
                                                <td colspan="6" class="text-center">
                                                    <div wire:loading.block wire:target="search" class="alert alert-warning" role="alert">
                                                        Sedang mencari data...
                                                    </div>
                                                </td>
                                            </tr>
        
                                            <div wire:loading.remove wire:target="search">
                                                @forelse ($score as $key => $item)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        
                                                    <td class="py-4 px-6">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        {{ $item->exam->title }}
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        {{ $item->exam->courseLesson->title }}
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        <div class="text-sm">
                                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        {{ $item->score }}
                                                    </td>
                                                    <td class="py-4 px-6 flex">
        
                                                        <a href="{{ route('mentor.exam-score.show', $item->id) }}" class="py-2 mr-2 mt-2 text-green-500 hover:text-gray-800" data-tooltip-target="tooltip-eye">
                                                            <i class="fa fa-eye"></i>
                                                            <div id="tooltip-eye" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-light text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Lihat Jawaban
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </a>
                                                        {{-- <form action="{{ route('mentor.course.destroy', $item->id) }}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="py-2 mr-2 mt-2 text-red-500 hover:text-gray-800" onclick="return confirm('Are you sure?')" data-tooltip-target="tooltip-trash">
                                                                <i class="fa-regular fa-comments"></i>
                                                                <div id="tooltip-trash" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-light text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                    Kirim Masukkan
                                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                                </div>
                                                            </button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                                @empty
                                                @endforelse
                                            </div>
        
                                        </tbody>
        
                                    </div>
        
                                </div>
                            </table>
        
                        </div>
        
                    </div>
                </main>
            </div>

        </section>

    </main>

@endsection
