@extends('layouts.learning.app')

@section('title', 'Detail Order')
@section('content')

    <div id="lesson">
        <div class="container-fluid bg-dark">
            <div class="container-fluid row col-sm-12 p-4">

                <aside class="col-sm-3 p-3 nav-bg" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between" style="align-items: center;">
                        <img src="https://class.buildwithangga.com/images/ic_burger-opened.svg" alt="">
                        {{-- <img src="https://class.buildwithangga.com/images/ic_burger-opened.svg" alt=""> --}}
                        <a href="{{ route('member.dashboard.index') }}"
                            style="color: darkgray; text-decoration: none; margin-right:20px;">Dashboard</a>
                        {{-- <p>{{ $CourseActive }}</p> --}}
                    </div>
                    <div class="flex mb-4">
                        {{-- <h5 class="mt-3 d-inline-block">Dark Mode</h5>
                        <input type="checkbox" class="" name="" id=""> --}}
                    </div>
                    <nav class="sidebar py-2 mb-4 nav-bg">
                        <ul class="nav flex-column" id="nav_accordion">
                            @foreach ($chapter as $key => $item)
                                <li class="nav-item has-submenu rounded-pill mb-2">
                                    <a class="nav-link white hover rounded-pill d-flex justify-content-between"
                                        href="#">
                                        <span>{{ $item->title }}</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="submenu collapse" id="{{ $item->id }}">
                                        @foreach ($material as $key => $m)
                                            @if ($m->course_lesson_id == $item->id)
                                                @if ($m->id == 1)
                                                    <li>

                                                        <a class="nav-link white hover rounded-pill mb-1 mt-2 d-flex justify-content-between"
                                                            href="{{ route('member.course.show', [$m->id]) }}">
                                                            <div>
                                                                <i class="bi bi-play-circle px-2"></i>
                                                                {{ $m->title }}
                                                            </div>
                                                            @livewire('checklist', [$m->id, $CourseActive[0]->id, 'm'])
                                                        </a>

                                                    </li>
                                                @else
                                                    <li>

                                                        <a class="nav-link white hover rounded-pill mb-1 mt-2 d-flex justify-content-between"
                                                            href="{{ route('member.course.materi', [$m->id]) }}">
                                                            <div>
                                                                <i class="bi bi-play-circle px-2"></i> {{ $m->title }}
                                                            </div>
                                                            @livewire('checklist', [$m->id, $CourseActive[0]->id, 'm'])
                                                        </a>

                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                        {{-- @if ($exam->count() > 0) --}}
                                        @foreach ($exam as $key => $e)
                                            @if ($e->course_lesson_id == $item->id)
                                                <li>
                                                    <a class="nav-link white hover rounded-pill mb-1 mt-2 d-flex justify-content-between"
                                                        href="{{ route('member.course.quiz', [$e->course_lesson_id]) }}">
                                                        <div>
                                                            <i class="fa-solid fa-clipboard-question mx-2 px-2"></i>
                                                            {{ $e->title }}
                                                        </div>
                                                        @livewire('checklist', [$e->id, $CourseActive[0]->id, 'q'])
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                        {{-- @endif --}}
                                    </ul>
                                </li>
                            @endforeach

                            <li class="nav-item has-submenu rounded-pill mb-2">
                                <a href="{{ route('member.comment.show', [$courses->id]) }}"
                                    class="nav-link white hover rounded-pill d-flex justify-content-between">
                                    Comment
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </aside>

                <div class="col-sm-9">
                    {{-- play vieo full width --}}

                    <div class="mb-4">
                        <video id="preview" style="border-radius: 20px" class="w-full ml-3 h-auto rounded-fill" controls>
                            <source id="video" src="{{ asset('images/course/video/' . $MateriActive->video_url) }}"
                                type="video/mp4">
                        </video>
                    </div>
                    <div class="d-flex justify-content-between p-4">
                        <div class="">
                            <input type="text" id="MateriActive" value="{{ $ChapterActive[0]->id }}" hidden>
                            <h5 class="white" style="color: darkgrey">{{ $MateriActive->title }}</h5>
                            <p class="white" style="color: darkgrey">Materi Bab : {{ $ChapterActive[0]->title }}
                            </p>
                        </div>
                        <span class="d-flex">
                            {{-- <a class="white hover p-2 bg-secondary rounded-pill" href="#">
                                Preview Video
                            </a> --}}
                            {{-- <a class="white hover p-2 nav-bg rounded-pill" style="height: 40px"
                                href="{{ route('member.course.materi', [$MateriActive->id + 1]) }}">
                                Next Video
                            </a> --}}
                            @livewire('next', [$ChapterActive[0]->id, $MateriActive->id, $aksesCourse[0]->id])
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        window.learning = function(ev) {
            console.log(ev);
            var video = document.getElementById('video');
            url = 'assets/video/courses/' + ev;
            console.log(url);
            return video.src = url;
            // return video.src = url;
        };

        let idMateriActive = document.getElementById('MateriActive');
        let idCourseActive = document.getElementById(idMateriActive.value);
        idCourseActive.classList.add('show');
        console.log(idMateriActive.value);
    </script>
@endpush
