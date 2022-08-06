@extends('layouts.app')

@section('title', 'Detail Order')
@section('content')

    <main class="h-full overflow-y-auto">
        {{-- <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        {{ $mentor->name ?? '' }}
                    </h2>

                    <p class="text-sm text-gray-400">
                        {{ $mentor->user_roles->name }}
                    </p>

                </div>
                <div class="col-span-4 lg:text-right">
                    <div class="relative mt-0 md:mt-6">

                        <button class="">

                        </button>
                        <form action="{{ route('admin.mentor-management.destroy', $mentor->id) }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="px-4 py-2 mt-2 text-left text-white bg-red-400 rounded-xl"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash-alt fa-lg"></i> Delete Mentor
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div> --}}

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">

                <li class="flex items-center">

                    <a href="{{ route('admin.mentor-management.index') }}" class="text-gray-400">Dashboard</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>

                </li>

                <li class="flex items-center">
                    <a href="#" class="font-medium">Details checkout</a>
                </li>

            </ol>
        </nav>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="bg-white rounded-xl">
                        <section class="pt-6 pb-20 mx-8 w-auth">
                            <div class="grid gap-5 md:grid-cols-12">

                                <main class="p-4 lg:col-span-12 md:col-span-12">

                                    <div class="grid grid-cols-12 gap-6">

                                        <div class="col-span-12 -mb-6">

                                            <label for="code" class="block mb-3 font-medium text-gray-700 text-md">Kode
                                                Transaksi</label>

                                        </div>

                                        <div class="col-span-12">
                                            <input placeholder="Code" type="text" name="code" id="code"
                                                autocomplete="code"
                                                class="bg-gray-300 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                value="{{ $checkout->midtrans_booking_code ?? '' }}" required readonly>

                                            @if ($errors->has('code'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('code') }}
                                                </p>
                                            @endif

                                        </div>


                                    </div>

                                    <div class="mt-6">
                                        <p class="block font-medium text-gray-700">Detail Member</p>
                                        <table>
                                            <tr>
                                                <td class="w-2/3">Name</td>
                                                <td class="w-1/3">:</td>
                                                <td class="w-1/3">{{ $checkout->user->name }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    {{-- user checkout, course, mentor, code_checkout, payment_status, tanggal_checkout, tanggal_dibayar --}}


                                </main>

                                {{-- <div class="p-4 md:text-right lg:col-span-6 md:col-span-12">
                                    <a href="#"
                                        class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                        See Reviews
                                    </a>

                                    <a href="{{ route('admin.mentor-management.edit', $checkout->id) }}"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-lg shadow-sm bg-serv-email hover:bg-serv-email-text focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-serv-email">
                                        Edit Mentor
                                    </a>
                                </div> --}}

                            </div>
                        </section>
                    </div>
                </main>
            </div>
        </section>
    </main>

@endsection
