@extends('layouts.app')


@section('title', 'Pengaturan Hak Akses')

@section('content')

<main class="h-full overflow-y-auto">

    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-12">

                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    Assign Hak Akse Menu
                </h2>

                <p class="text-sm text-gray-400">
                    Menambahkan hak akses menu pengguna
                </p>

            </div>
        </div>
    </div>

    <!-- breadcrumb -->
    <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">

            <li class="flex items-center">
                <a href="{{ route('role.index') }}" class="text-gray-400">Assign Permission</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>

            <li class="flex items-center">
                <a href="#" class="font-medium">Management Hak Akses</a>
            </li>

        </ol>
    </nav>

    <section class="container px-6 mx-auto mt-5">
        <div class="grid gap-5 md:grid-cols-12">
            <main class="col-span-12 p-4 md:pt-0">
                <div class="px-2 py-2 mt-2 bg-white rounded-xl">

                    <form action="{{ route('role.store') }}" method="POST" id="assignForm">
                        @csrf

                        <div class="py-5 px-5">

                            <p class="font-bold">
                                Role : {{$role->name}}
                            </p>
                            <hr>
                            <div class="grid md:grid-cols-12 mt-3 gap-5">
                                <div class="col-span-6">
                                    @foreach ($role->permissions as $permission)
                                        <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 cursor-pointer selected" onclick="toggleBadge(this)">{{$permission->name}}</span>
                                    @endforeach
                                </div>
                                <div class="col-span-6">
                                    <p class="font-normal">Tambahkan</p>
                                    @foreach ($permissionDoesNotHaveRole as $permission)
                                        <span class="text-xs font-medium me-2 px-2.5 py-0.5 rounded bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 cursor-pointer" onclick="toggleBadge(this)">{{$permission->name}}</span>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <input type="hidden" name="role" id="role" value="{{$role->name}}">
                        <input type="hidden" name="permissions" id="permissions" value="">

                        <div class="px-4 py-3 text-right sm:px-6">
                            <x-form.button-cancel route='role.index' />
                            <button class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" onclick="saveSelectedBadges()">Simpan</button>
                        </div>

                    </form>

                </div>
            </main>
        </div>
    </section>

</main>

@push('after-script')

    <script>
        // console.log());
        var selectedBadges = @json($role->permissions()->pluck('name'));

        function toggleBadge(badge) {
            badge.classList.toggle("selected");
            var badgeName = badge.innerText;
            console.log(selectedBadges);

            if (selectedBadges.includes(badgeName)) {
                selectedBadges = selectedBadges.filter(name => name !== badgeName);
            } else {
                selectedBadges.push(badgeName);
            }

            if (badge.classList.contains("selected")) {
                badge.classList.add("bg-green-100", "text-green-800", "dark:bg-green-900", "dark:text-green-300");
                badge.classList.remove("bg-red-100", "text-red-800", "dark:bg-red-900", "dark:text-red-300");
            } else {
                badge.classList.remove("bg-green-100", "text-green-800", "dark:bg-green-900", "dark:text-green-300");
                badge.classList.add("bg-red-100", "text-red-800", "dark:bg-red-900", "dark:text-red-300");
            }

        }

        function saveSelectedBadges() {

            var selectedBadgesInput = document.getElementById('permissions');
            selectedBadgesInput.value = JSON.stringify(selectedBadges);
            document.getElementById('assignForm').submit();

        }
    </script>

@endpush
@endsection
