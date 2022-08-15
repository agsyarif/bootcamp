<div class="">

    <div class="grid gap-5 md:grid-cols-12">
        <main class="col-span-12 p-4 md:pt-0">
            <div class="px-6 py-2 mt-2 bg-white rounded-lg">


                <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">
                    <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                        <div>
                            {{-- <a href="{{ route('admin.mentor-management.create') }}"
                                class="inline-block px-4 py-2 mt-2 text-left text-white rounded-lg bg-serv-button">
                                + Tambah Mentor
                            </a> --}}
                            {{-- <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                <span class="sr-only">Action button</span>
                                Action
                                <svg class="ml-2 w-3 h-3" aria-hidden="true" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownAction"
                                class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 block hidden"
                                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 46px);">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownActionButton">
                                    <li>
                                        <button wire:click="aksi('terbaru')"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Terbaru</button>
                                    </li>
                                    <li>
                                        <button wire:click="aksi('active')"
                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                            account</button>
                                    </li>
                                </ul>
                                <div class="py-1">
                                    <a href="#"
                                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                        User</a>
                                </div>
                            </div> --}}
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
                                placeholder="Search for mentors">
                            {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
                        </div>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    No
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Nama
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    No Telp.
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Skill
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
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
                                        <th scope="row"
                                            class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">

                                            @if ($men->profile_photo_path != null)
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ url($men->profile_photo_path) }}" alt="thumbnail"
                                                    loading="lazy" />
                                            @else
                                                <img class="w-10 h-10 rounded-full"
                                                    src="{{ url('https://randomuser.me/api/portraits/men/3.jpg') }}"
                                                    alt="" loading="lazy" />
                                            @endif

                                            <div class="ml-3 pl-3">
                                                <div class="text-base font-semibold">{{ $men->name ?? '-' }}</div>
                                                <div class="font-normal text-gray-500">{{ $men->email ?? '-' }}</div>
                                            </div>
                                        </th>
                                        <td class="py-4 px-6">
                                            {{ $men->contact_number ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $men->skill_id ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center">
                                                @if ($men->is_active == 1)
                                                    <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div>
                                                    <span class="text-grey-800">Active</span>
                                                @else
                                                    <div class="h-2.5 w-2.5 rounded-full bg-red-400 mr-2"></div>

                                                    <span class="text-red-500">Non Active
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 flex">
                                            <a href="{{ route('admin.member-management.show', $men['id']) }}"
                                                class="py-2 mt-2 text-serv-yellow hover:text-gray-800">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.member-management.edit', $men['id']) }}"
                                                class="px-2 py-2 mt-2 text-green-500 hover:text-gray-800">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('admin.member-management.destroy', $men->id) }}"
                                                method="post">
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

    {{-- <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <input type="text" wire:model.debounce.300ms="search" id="table-search-users"
            class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search for mentors">
    </div>
    <div wire:loading.block wire:target="search" class="alert alert-warning" role="alert">
        Sedang mencari data...
    </div>
    <div wire:loading.remove wire:target="search">

        <p>{{ $data }}</p>
        <p>{{ $search }}</p>
        <p>{{ $segment }}</p>

    </div> --}}


</div>
