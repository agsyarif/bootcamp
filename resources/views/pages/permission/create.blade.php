@extends('layouts.app')

@section('title', 'Pengaturan Hak Akses')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Hak Akses Menu
                    </h2>

                    <p class="text-sm text-gray-400">
                        pengaturan hak akses menu pengguna
                    </p>

                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">

                <li class="flex items-center">
                    <a href="{{ route('mentor-management.index') }}" class="text-gray-400">My Mentor</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>

                <li class="flex items-center">
                    <a href="#" class="font-medium">Add Your Mentor</a>
                </li>

            </ol>
        </nav>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">

                        <form action="{{ route('permission.store') }}" method="POST">
                            @csrf

                            <div class="">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <x-form for='name' forView=Name placeholder='nama akses menu' type='text' name='name' id='name' isRequired='true' />

                                        <x-form for='guard_name' forView='Guard Name' placeholder='Guard Name' type='text' name='guard' id='guard' isRequired='true' value='web'/>

                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 text-right sm:px-6">
                                <x-form.button-cancel route='permission.index' />
                                <x-form.button-submit viewName='Create Hak Akses' />
                            </div>

                        </form>

                    </div>
                </main>
            </div>
        </section>

    </main>


@endsection
