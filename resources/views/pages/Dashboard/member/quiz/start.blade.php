@extends('layouts.learning.app')

@section('title', 'Detail Order')
@section('content')


    <div id="lesson">
        <div class="container-fluid bg-dark">
            <div class="container-fluid row col-sm-12 p-4">


                <div class="col-sm-12">

                    <div class="section-body">
                        <div class="mb-4">
                            <div class="card nav-bg" style="border-radius: 20px">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-12  text-white mt-3">
                                            <p>
                                                <i class="fa-solid fa-clipboard-question mx-2"></i>
                                                {{ $exam[0]->title }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <!-- Display the countdown timer in an element -->
                                            <span class="badge badge-danger" id="timer"></span>
                                        </div>
                                    </div>
                                </div>
                                @if ($question->count() == null)
                                    <span class="text-center px-3 py-3">Soal Kosong</span>
                                @else
                                    {{-- <span>{{ $question }}</span> --}}
                                    @livewire('quiz', [$id, 'segment' => 'start'])
                                @endif
                                {{-- @livewire('counter', [$id]) --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between p-4">
                        <div class="">
                            <h5 class="white" style="color: darkgrey">{{ $MateriActive[0]->title }}</h5>
                            <p class="white" style="color: darkgrey">Materi Bab : {{ $ChapterActive->title }}
                            </p>
                        </div>
                        <span class="d-flex">
                            {{-- <a class="white hover p-2 bg-secondary rounded-pill" href="#">
                                Preview Video
                            </a> --}}
                            {{-- <a class="white hover p-2 nav-bg rounded-pill" style="height: 40px"
                                href="{{ route('member.course.materi', [$MateriActive[0]->id + 1]) }}">
                                Next Video
                            </a> --}}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
