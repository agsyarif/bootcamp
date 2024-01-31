@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <main class="h-full overflow-y-auto">

        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Role User
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{$roles->count()}} Total Role User
                    </p>
                </div>

                <div class="col-span-4 lg:text-right">
                    <div class="relative mt-0 md:mt-6">
                        <x-button.button route='admin.permission.create' viewName='+ Tambah Role' />
                    </div>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">

            <div class="">

                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">
                        <div class="px-6 py-2 mt-2 bg-white rounded-lg">

                            <div class="overflow-x-auto pt-6 pb-6 relative shadow-md sm:rounded-lg">

                                <div class="flex justify-between items-center pb-4 bg-white dark:bg-gray-900">
                                    <div>

                                    </div>

                                    <x-table.search placeholder='Cari berdasarkan nama Role'/>

                                </div>

                                <x-table.table
                                collections="{!! json_encode($roles) !!}"
                                headers="{!! json_encode(['name','hak akses']) !!}"
                                keys="{!! json_encode(['name', 'permissions']) !!}"
                                isAction=true
                                actions="{!! json_encode([
                                    [
                                        'route' => 'admin.assign.show',
                                        'icon' => 'fa fa-eye',
                                        'color' => 'text-serv-yellow'
                                    ],
                                    [
                                        'route' => 'admin.assign.edit',
                                        'icon' => 'fa-pen-to-square',
                                        'color' => 'text-green-500'
                                    ],
                                    [
                                        'route' => 'admin.assign.destroy',
                                        'icon' => 'fa-trash-can',
                                        'color' => 'text-red-500'
                                    ]
                                ])!!}"
                                />

                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>



    </main>

@endsection
