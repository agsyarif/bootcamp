@extends('layouts.app')

@section('title', 'Priview Materi')

@section('content')

    <div class="container mx-auto">
        <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
            <div class="col-span-8">

                <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                    {{ $answerUser->exam->title ?? '' }}
                </h2>

                <p class="text-sm text-gray-400">
                    {{ optional($answerUser->exam)->questions != null ? optional($answerUser->exam)->questions->count() : 0}} Soal
                </p>
            </div>
        </div>
    </div>
    
    <!-- breadcrumb -->
    <nav class="mx-10 mt-8 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex p-0 list-none">

            <li class="flex items-center">
                <a href="{{ route('mentor.course.index') }}" class="text-gray-400">My Course</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('mentor.member.show', $answerUser->aksesCourse->course_id) }}" class="text-gray-400">Member Course</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="{{ route('mentor.exam-score.show', optional($answerUser)->id) }}" class="text-gray-400">Nilai Kuis</a>
                <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 320 512">
                    <path
                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                </svg>
            </li>
            <li class="flex items-center">
                <a href="#" class="font-medium">Jawaban</a>
            </li>

        </ol>
    </nav>


    <div class="mt-5 mx-10 p-2 pl-5 bg-white sm:rounded-lg grid grid-cols-6">
        <div class="col-span-3">
            <p class="text-md font-medium">Nama Member <span class="ml-4">:</span> {{$answerUser->aksesCourse->user->name}}</p>
            <p class="text-md font-medium">Dikerjakan Pada <span class="ml-1">:</span> {{ \Carbon\Carbon::parse($answerUser->updated_at)->isoFormat('dddd, D MMMM Y') }}</p>
        </div>
        <div class="col-span-3">
            <p class="text-md font-medium">Judul Kuis <span class="ml-1">:</span> {{$answerUser->exam->title}}</p>
            <p class="text-md font-medium">Total Nilai <span class="ml-2">:</span> {{$answerUser->score}}</p>
        </div>
    </div>

    <div class="mt-2 mx-10 pt-4 pl-4 bg-white sm:rounded-lg">
        {{-- <div class="col-span-6"> --}}
        @php
            $answers = json_decode($answerUser->answers, true);
        @endphp
        @foreach ($answers as $item)
            <div class="flex items-center gap-2 pb-3">
                <div class="rounded-full ring-offset-2 ring-2 py-1 w-8 text-center">{{ $loop->iteration }}</div>
                <div>{{ $answerUser->exam->getQuestionByQuestionId($item['questionId']) }}</div>
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
                        <p>{{$answerUser->exam->getExplanationByQuestionId($item['questionId'])}}</p>
                    </div>
                </div>
            </div>
            <hr class="w-full mt-4 pb-4">
        @endforeach
        {{-- </div> --}}
    </div>

    <div class="grid grid-cols-6 gap-6">
        
    </div>

@endsection
