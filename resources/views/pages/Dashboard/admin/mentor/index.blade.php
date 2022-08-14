@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Mentor
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $mentor->count() ?? '' }} Total Mentor
                    </p>
                </div>

                <div class="col-span-4 lg:text-right">
                    <div class="relative mt-0 md:mt-6">
                        <a href="{{ route('admin.mentor-management.create') }}"
                            class="inline-block px-4 py-2 mt-2 text-left text-white rounded-lg bg-serv-button">
                            + Tambah Mentor
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            @livewire('admin.search', ['segment' => 'mentor-management'])

            {{-- <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-lg">


                        <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">
                            <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                                <div>
                                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
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
                                        data-popper-reference-hidden="" data-popper-escaped=""
                                        data-popper-placement="bottom"
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 46px);">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="dropdownActionButton">
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                                                    account</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#"
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                                                User</a>
                                        </div>
                                    </div>
                                </div>
                                <label for="table-search" class="sr-only">Search</label>
                                @livewire('admin.search', ['segment' => 'mentor-management'])
                            </div>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                    @forelse ($mentor as $key => $men)
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
                                                <a href="{{ route('admin.mentor-management.show', $men['id']) }}"
                                                    class="py-2 mt-2 text-serv-yellow hover:text-gray-800">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.mentor-management.edit', $men['id']) }}"
                                                    class="px-2 py-2 mt-2 text-green-500 hover:text-gray-800">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <form action="{{ route('admin.mentor-management.destroy', $men->id) }}"
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
                                </tbody>
                            </table>
                        </div>

                    </div>
                </main>
            </div> --}}
        </section>
    </main>

@endsection
