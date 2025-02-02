@extends('layouts.app')

@section('title', 'Create My Course')
@section('content')

    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Add Your Exam
                    </h2>

                    <p class="text-sm text-gray-400">
                        Upload the Exam you provide
                    </p>

                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">

                <li class="flex items-center">
                    <a href="{{ route('courses.index') }}" class="text-gray-400">Exam</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>

                <li class="flex items-center">
                    <a href="#" class="font-medium">Add Your Exam</a>
                </li>

            </ol>
        </nav>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">

                        <form action="{{ route('exam.store') }}" method="POST">
                            @csrf

                            <div class="">
                                <div class="px-4 py-5 sm:p-6">

                                    <div class="grid grid-cols-6 gap-6">

                                        <x-form for='course_id' forView='Kursus' placeholder='Judul kursus' type='text' name='title' id='title' isRequired='true' value='{{$chapter->course->name}}' readonly=true/>

                                        <div class="col-span-6 sm:col-span-3">

                                            <div class="flex justify-between items-center">
                                                <label for="chapter_id" class="block mb-2 font-medium text-gray-700 text-md">
                                                    Chapter
                                                </label>
                                            </div>

                                            <select id="chapter_id" name="chapter_id" autocomplete="chapter"
                                                class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>

                                                <option>-- Pilih Chapter --</option>

                                                @foreach (json_decode($chapter->course->chapters) as $col)
                                                        <option value={{ $col->id }} {{$col->id == $chapter->id ? 'selected' : ''}}>{{ $col->title }}</option>
                                                @endforeach

                                            </select>

                                            @if ($errors->has('chapter_id'))
                                                <p class="text-red-500 mb-3 text-sm">
                                                    {{ $errors->first('chapter_id') }}
                                                </p>
                                            @endif

                                        </div>

                                        <x-form for='title' forView='title' placeholder='Judul Ujian' type='text' name='title' id='title' isRequired='true'/>

                                        <x-form for='duration' forView='duration' placeholder='Durasi Ujian' type='number' name='duration' id='duration' isRequired='true'/>


                                    </div>

                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">

                                    <a href="{{ route('materi.show', $chapter->id) }}" type="button"
                                        class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                        onclick="return confirm('Are you sure want to cancel? , Any changes you make will not be saved !')">
                                        Cancel
                                    </a>

                                    <button type="submit"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        onclick="return confirm('Are you sure want to submit this data ?')">
                                            Submit Ujian
                                    </button>

                                </div>

                            </div>
                        </form>

                    </div>
                </main>
            </div>
        </section>
    </main>

@endsection

@push('after-script')
    <script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js') }}"></script>
@endpush
