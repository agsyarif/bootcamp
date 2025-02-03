<div class="">

    <div class="grid gap-5 md:grid-cols-12">
        <main class="col-span-12 p-4 md:pt-0">
            <div class="px-6 py-2 mt-2 bg-white rounded-lg">

                <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">
                    <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                        <div>

                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" wire:model.debounce.300ms="search" id="table-search-users"
                                class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search of Member">
                        </div>
                    </div>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6">No
                                        </th>
                                        <th class="py-4 px-6">Nama</th>
                                        <th class="py-4 px-6">bergabung sejak</th>
                                        <th class="py-4 px-6">Progress</th>
                                        <th class="py-4 px-6">Rekap Nilai</th>
                                        <th class="py-4 px-6">Aksi</th>
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
                                        @if ($data)

                                            @forelse ($data as $key => $item)
                                                <tr
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                    <td class="py-4 px-6">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
                                                        @if ($item->user->profile_photo_path != null)
                                                        @if ($item->user->profile_photo_path[0] == 'h')
                                                            <img src="{{ $item->user->profile_photo_path }}" alt="Photo Profile"
                                                                class="inline ml-3 h-12 w-12 rounded-full">
                                                        @else
                                                            <img src="{{ asset('images/profile/' . $item->user->profile_photo_path) }}"
                                                                alt="Photo Profile" class="inline ml-3 h-12 w-12 rounded-full">
                                                        @endif
                                                        @else
                                                            <img src="{{asset('assets/images/user.png')}}" class="inline ml-2 h-10 w-10 rounded-full" />
                                                        @endif

                                                        <div class="ml-3 pl-3">
                                                            <div class="text-base font-semibold">{{ $item->user->name ?? '-' }}</div>
                                                            <div class="font-normal text-gray-500">{{ $item->user->email ?? '-' }}</div>
                                                        </div>
                                                    </th>
                                                    <td class="py-4 px-6">
                                                        <div class="text-sm">
                                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        <div class="text-sm">
                                                            @php
                                                                $material = 0;
                                                            @endphp
                                                            @foreach ($item->course->course_lessons as $chapter)
                                                                @php $material += $chapter->courseMaterials->count() @endphp
                                                            @endforeach
                                                            {{ number_format($item->detail_akses_course->count() / $material * 100, 2) }}%
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-6">
                                                        <div class="text-sm">
                                                            @php
                                                                $examScore = 0;
                                                            @endphp
                                                            @foreach ($item->examScore as $score)
                                                                @php $examScore += $score->score @endphp
                                                            @endforeach
                                                            @if ($examScore > 0)
                                                                {{$examScore / $item->examScore->count() }}
                                                            @else
                                                                {{ $examScore }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="py-4 px-6 flex">

                                                        <a href="{{ route('exam-score.show', $item->id) }}"
                                                            class="py-2 mr-2 mt-2 text-green-500 hover:text-gray-800" data-tooltip-target="tooltip-eye">
                                                            <i class="fa fa-clipboard-question"></i>
                                                            <div id="tooltip-eye" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-light text-white bg-gray-700 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                                Detail Nilai
                                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                                            </div>
                                                        </a>
                                                        {{-- <form action="{{ route('course.destroy', $item->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="py-2 mr-2 mt-2 text-red-500 hover:text-gray-800"
                                                                onclick="return confirm('Are you sure?')"
                                                                data-tooltip-target="tooltip-trash">
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

                                        @endif
                                    </div>

                                </tbody>

                            </div>

                        </div>
                    </table>

                </div>

            </div>
        </main>
    </div>

</div>
