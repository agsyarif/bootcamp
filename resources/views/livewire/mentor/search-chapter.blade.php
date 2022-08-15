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
                                placeholder="Search of Course">
                        </div>
                    </div>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6">No
                                        </th>
                                        <th class="py-4 px-6">Judul Bab</th>
                                        <th class="py-4 px-6">Materi</th>
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
                                        @forelse ($data as $key => $item)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                                <td class="py-4 px-6">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    <div class="text-sm">

                                                        <a href="{{ route('mentor.materi.edit', $item->id) }}"
                                                            class="font-medium text-black">
                                                            {{ $item->title ?? '' }}
                                                        </a>

                                                    </div>
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $materi->where('course_lesson_id', $item->id)->count() }}
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $item->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $item->id }}">
                                                        <i class="fas fa-chevron-down"></i>
                                                    </button>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <div class="text-sm">

                                                        <a href="{{ route('mentor.chapter.edit', $item->id) }}"
                                                            class="px-3 py-2 mt-2 text-green-500 hover:text-gray-800">
                                                            <i class="fas fa-edit fa-lg"></i>
                                                        </a>

                                                        <form class="inline"
                                                            action="{{ route('mentor.chapter.destroy', $item->id) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="ml-4 py-2 mt-2 text-red-500 hover:text-gray-800"
                                                                onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash-alt fa-lg"></i>

                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            @if ($materi->where('course_lesson_id', $item->id)->count() > 0)
                                                <thead>
                                                    <tr id="collapse{{ $item->id }}"
                                                        aria-labelledby="heading{{ $item->id }}"
                                                        data-bs-parent="#accordionExample"
                                                        class="bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            <th class="py-4 px-6">No</th>
                                                            <th class="py-4 px-6">Title</th>
                                                            <th class="py-4 px-6">Video Url</th>
                                                            <th class="py-4 px-6">Action</th>
                                                        </div>
                                                    </tr>
                                                </thead>


                                                @foreach ($materi->where('course_lesson_id', $item->id) as $m)
                                                    <tr id="collapse{{ $item->id }}"
                                                        aria-labelledby="heading{{ $item->id }}"
                                                        data-bs-parent="#accordionExample"
                                                        class="bg-gray-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 accordion-collapse collapse">

                                                        <div class="accordion-body">
                                                            <td class="py-4 px-6">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td class="py-4 px-6">
                                                                <a href="{{ route('mentor.priview.show', $m->id) }}">
                                                                    {{ $m->title }}
                                                                </a>
                                                            </td>
                                                            <td class="py-4 px-6">
                                                                <a href="{{ route('mentor.priview.show', $m->id) }}">
                                                                    {{ $m->video_url }}
                                                                </a>
                                                            </td>
                                                            <td class="py-4 px-6">
                                                                <div class="text-sm">
                                                                    <a href="{{ route('mentor.materi.edit', $m->id) }}"
                                                                        class="px-3 py-2 mt-2 text-green-500 hover:text-gray-800">
                                                                        <i class="fas fa-edit fa-lg"></i>
                                                                    </a>
                                                                    <form class="inline"
                                                                        action="{{ route('mentor.materi.destroy', $m->id) }}"
                                                                        method="post">
                                                                        @method('delete')
                                                                        @csrf
                                                                        <button
                                                                            class="ml-4 py-2 mt-2 text-red-500 hover:text-gray-800"
                                                                            onclick="return confirm('Are you sure?')">
                                                                            <i class="fas fa-trash-alt fa-lg"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </div>

                                                    </tr>
                                                @endforeach
                                            @endif
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

</div>
