@extends('layouts.app')

@section('title', 'show progress belajar')

@section('content')

    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">

                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    {{ $aksesCourse->course->name ?? '' }}
                </h2>

                <p class="text-sm text-gray-400">
                    {{ optional($aksesCourse)->score != null ? optional($aksesCourse)->course->getCountExams() : 0}} Kuis
                </p>
            </div>
        </div>
    </div>
    
    <!-- breadcrumb -->
    <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">

            <li class="flex items-center">
                <a href="{{ route('member.progress.index') }}" class="text-gray-400">Progress Belajar</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="font-medium">Detail</a>
            </li>

        </ol>
    </nav>

    {{-- ============== test ================ --}}
    {{-- <div class="mt-5 mx-10 p-2 pl-5 bg-white sm:rounded-lg grid grid-cols-6">
        <div class="col-span-3">
            <p>Nilai Rata - Rata = {{ $aksesCourse->getSumScore() }}</p>
        </div>
        <div class="col-span-3">
        </div>
    </div> --}}

    <div class="mt-2 mx-10 p-2 pl-5 bg-white sm:rounded-lg grid grid-cols-6">

        <div class="col-span-1">
            <ul role="list" class="divide-y divide-gray-100">
                <li class="">
                    <div class="flex gap-x-4">
                        <div class="min-w-0 flex-auto items-center">
                            <p class="text-center py-4 px-6 text-gray-800 font-semibold">Daftar Kuis</p>
                        </div>
                    </div>
                </li>
                @foreach ($aksesCourse->score as $key => $score)
                    <li class="flex justify-between gap-x-6 py-5">
                        <div class="flex gap-x-4">
                            <div class="min-w-0 flex-auto">
                                <a href="#" onclick="activateTab(event, '{{$key}}')" class="linkTabs py-4 px-6 bg-gray-200 text-gray-800 font-semibold">{{$loop->iteration}}. {{ $score->exam->getTitleLimit() }}</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-span-4">
            @foreach ($aksesCourse->score as $key => $score)
                <div id="tab-content-{{$key}}" class="tab-content">

                    <div class="px-4 h-full">
                        <div class="flex justify-between rounded-md p-2">
                            <div>
                                <p class="text-md font-medium">Judul<span class="ml-4">:</span> {{$score->exam->title}}</p>
                                <p class="text-md font-medium">Nilai <span class="ml-5"> :</span> {{$score->score}}</p>
                            </div>
                            <div>
                                {{-- <p class="text-md font-medium">Jawaban Benar <span class="ml-4">:</span> {{$score->getAnswerTrue()}}</p>
                                <p class="text-md font-medium">Jawaban Salah <span class="ml-5">:</span> {{$score->getAnswerFalse()}}</p> --}}
                            </div>
                        </div>
                    </div>
                    <hr class="w-full mt-1 pb-4">
                    @php
                    $answers = json_decode($score->answers, true);
                    @endphp

                    @foreach ($answers as $item)
                    <div class="ml-4 mt-4">
                        <div class="flex items-center gap-2 pb-3">
                            <div class="rounded-full ring-offset-2 ring-2 py-1 w-8 text-center">{{ $loop->iteration }}</div>
                            <div class="setKey">{{ $score->exam->getQuestionByQuestionId($item['questionId']) }}</div>
                        </div>
                        <div class="grid grid-cols-6">
                            <div class="col-span-3 pl-5">
                                <div class="ml-5 p-1 pl-4 @if ($item['option1'] == $item['questionAnswer']) border-green-300 @else  border-cyan-300 @endif border-2 rounded-md mb-2 @if ($item['option1'] == $item['userAnswer']) @if ($item['is_true'] == 1) bg-green-500 @elseif ($item['is_true'] == 0) bg-red-500 @endif @endif">
                                    <span class="mr-3">A</span> {{ $item['option1']}}
                                </div>
                                <div class="ml-5 p-1 pl-4 @if ($item['option2'] == $item['questionAnswer']) border-green-300 @else  border-cyan-300 @endif border-2 rounded-md mb-2 @if ($item['option2'] == $item['userAnswer']) @if ($item['is_true'] == 1) bg-green-500 @elseif ($item['is_true'] == 0) bg-red-500 @endif @endif">
                                    <span class="mr-3">B</span> {{ $item['option2']}}
                                </div>
                                <div class="ml-5 p-1 pl-4 @if ($item['option3'] == $item['questionAnswer']) border-green-300 @else  border-cyan-300 @endif border-2 rounded-md mb-2 @if ($item['option3'] == $item['userAnswer'])  @if ($item['is_true'] == 1) bg-green-500 @elseif ($item['is_true'] == 0) bg-red-500 @endif @endif">
                                    <span class="mr-3">C</span> {{ $item['option3']}}
                                </div>
                                <div class="ml-5 p-1 pl-4 @if ($item['option4'] == $item['questionAnswer']) border-green-300 @else  border-cyan-300 @endif border-2 rounded-md mb-2 @if ($item['option4'] == $item['userAnswer']) @if ($item['is_true'] == 1) bg-green-500 @elseif ($item['is_true'] == 0) bg-red-500 @endif @endif">
                                    <span class="mr-3">D</span> {{ $item['option4']}}
                                </div>
                            </div>
                            <div class="col-span-3 px-4 h-full">
                                <div class="rounded-md p-2 bg-gray-100">
                                    <p>Pembahasan : </p>
                                    <p>{{$score->exam->getExplanationByQuestionId($item['questionId'])}}</p>
                                </div>
                            </div>
                        </div>
                        <hr class="w-full mt-4 pb-4">
                    </div>
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>
    
    {{-- ============================== --}}


    @push('after-script')
    <script>
       function activateTab(event, key) {
        event.preventDefault();

        const tabs = document.querySelectorAll('.tab-content');
        // const links = document.querySelectorAll('nav a');
        const links = document.querySelectorAll('a.linkTabs');
        console.log(key);
        // Menghilangkan class 'hidden' dari konten tab yang dipilih
        tabs.forEach(tab => {
            tab.classList.add('hidden');
        });
        document.getElementById(`tab-content-${key}`).classList.remove('hidden');

        // Menambahkan class 'bg-gray-200' pada link tab yang dipilih
        links.forEach(link => {
            link.classList.remove('bg-gray-200', 'text-gray-800', 'font-semibold');
            link.classList.add('text-gray-600');
        });
        links[key].classList.add('bg-gray-200', 'text-gray-800', 'font-semibold');
    }
    </script>
    @endpush
@endsection
