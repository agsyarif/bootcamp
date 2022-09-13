<section class=" w-full border-box transition-all duration-500 linear lg:px-16 md:px-20 px-8"
    style="background-color: #212529;">
    <div class="navbar-1-1">
        <div class="mx-auto flex flex-wrap flex-row
        items-center justify-between">


            {{-- <a href="{{ route('index') }}" class="flex items-center">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" class="ml-3">
            </a> --}}
            {{-- <div style="background-color: brown"> --}}

            <svg viewBox="0 0 700 120" class="desktop" id="svg">
                <text x="40%" y="70%" fill="" text-anchor="middle">
                    UwhCamp
                </text>
            </svg>
            <svg viewBox="0 0 700 120" class="mobile" id="svg">
                <text x="40%" y="70%" fill="" text-anchor="middle">
                    Uwhcamp
                </text>
            </svg>
            {{-- </div> --}}

            <div>
                <label for="menu-toggle" class="cursor-pointer lg:hidden block" @click="toggleSideMenu"
                    aria-label="Menu">
                    <svg class="w-6 h-6" fill="none" stroke="#092A33" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </label>

                <input class="hidden" type="checkbox" id="menu-toggle" />
            </div>

            {{-- mobile --}}

            <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto md:hidden nav-bg"
                style="margin-left: -30px" x-show="isSideMenuOpen"
                x-transition:enter="transition ease-in-out duration-150"
                x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
                @keydown.escape="closeSideMenu" aria-label="aside">

                <div class="text-gray-500 dark:text-gray-400">
                    <h5 class="mob:font2 text-center text-white p-4">Modul Materi</h5>
                    <nav class="sidebar py-2 mb-4 nav-bg">
                        <ul class="nav flex-column" id="nav_accordion">
                            @foreach ($chapter as $key => $item)
                                <li class="nav-item has-submenu mb-2">
                                    <a class="nav-link text-white hover d-flex justify-content-between" href="#">
                                        <span>{{ $item->title }}</span>
                                        <i class="bi bi-chevron-down"></i>
                                    </a>
                                    <ul class="submenu collapse" id="{{ $item->id }}">
                                        @foreach ($material as $key => $m)
                                            @if ($m->course_lesson_id == $item->id)
                                                @if ($m->id == 1)
                                                    <li>

                                                        <a class="nav-link text-white hover mb-1 mt-2 d-flex justify-content-between"
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

                                                        <a class="nav-link text-white hover mb-1 mt-2 d-flex justify-content-between"
                                                            href="{{ route('member.course.materi', [$m->id]) }}">
                                                            <div>
                                                                <i class="bi bi-play-circle px-2"></i>
                                                                {{ $m->title }}
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
                                                    <a class="nav-link text-white hover mb-1 mt-2 d-flex justify-content-between"
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

                            <li class="nav-item has-submenu mb-2">
                                <a href="{{ route('member.comment.show', [$courses->id]) }}"
                                    class="nav-link text-white hover d-flex justify-content-between">
                                    Comment
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </aside>
            {{-- mobile --}}

            {{-- button-menu-mobile --}}
            {{-- <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                @click="toggleSideMenu" aria-label="Menu">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button> --}}
            {{-- button-menu-mobile --}}

            {{-- @auth

                <div @click.away="open = false" class="hidden lg:block relative" x-data="{ open: false }">

                    <button @click="open = !open"
                        class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">

                        <span style="color: text-white;">
                            Halo, {{ Auth::user()->name }}
                        </span>

                        @if (auth()->user()->first()->profile_photo_path != null)
                            <img src="{{ asset('assets/images/profile/' . auth()->user()->profile_photo_path) }}"
                                alt="" class="inline ml-3 h-12 w-12 rounded-full">
                        @else
                            <img class="inline ml-3 h-12 w-12 rounded-full"
                                src="{{ url('https://randomuser.me/api/portraits/men/1.jpg') }}" alt="">
                        @endif

                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{ 'rotate-180': open, 'rotate-0': !open }"
                            class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">

                        <div class="px-2 py-2 rounded-md shadow dark-mode:bg-gray-800" style="background: #212529">

                            @if (Auth::user()->user_role_id == 1)
                                <a class="block text-white px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 2)
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('mentor.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 3)
                                <a class="block text-white px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('member.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 4)
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="tutor.dashboard.index">Dashboard</a>
                            @endif

                            <a class="block text-white px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                href="{{ url('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout

                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                    @csrf
                                </form>

                            </a>

                        </div>
                    </div>
                </div>

            @endauth --}}

        </div>
    </div>
</section>
