<div class="">

    <div class="grid gap-5 md:grid-cols-12">
        <main class="col-span-12 p-4 md:pt-0">
            <div class="px-6 py-2 mt-2 bg-white rounded-lg">


                <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">
                    <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                        <div>

                        </div>

                        <x-table.search placeholder='Search Mentor' />

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
                                    Wallet
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
                                        <td class="py-4 px-6">
                                            @if(empty(optional($men->wallet())->wallet_id))
                                                <form action="{{ route('admin.create-wallet', [$men->id]) }}" method="post">
                                                    @method('post')
                                                    @csrf
                                                    <button class="py-2 mt-2 text-red-500 hover:text-gray-800">
                                                        + Create
                                                    </button>
                                                </form>
                                            @else
                                                {{ optional($men->wallet())->wallet_id }}
                                            @endif
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
                            </div>
                        </tbody>
                    </table>

                    <div>
                        {{$data->onEachSide(5)->links()}}
                        {{ $data->links() }}
                    </div>

                </div>

            </div>
        </main>
    </div>

</div>
