<div>
    @forelse ($data as $key => $men)
        {{ $men->course_lesson_id }}
    @empty
    @endforelse

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
                                placeholder="Search for transactions">
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    No
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Judul Ujian
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Kursus
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Bab
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Durasi
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Total Soal
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Aksi
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
                                @forelse ($data as $key => $men)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                        <td class="py-4 px-6">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $men->title ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if ($men->course != null)
                                                @foreach ($men->course as $item)
                                                    {{ $item }}
                                                @endforeach
                                            @endif
                                        </td>

                                        <td class="py-4 px-6">
                                            {{ $men->courseLesson->title ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $men->duration ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                {{ $question->where('exam_id', $men->id)->count() }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 flex gap-2">
                                            <a href="{{ route('mentor.exam.show', $men->id) }}"
                                                class="py-2 mt-2 text-green-500 hover:text-gray-800">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('mentor.exam.edit', $men->id) }}"
                                                class="py-2 mt-2 text-serv-yellow hover:text-gray-800">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('mentor.exam.destroy', $men->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="py-2 mt-2 text-red-500 hover:text-gray-800"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </div>
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>
</div>
