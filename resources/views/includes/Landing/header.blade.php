<section class="h-full w-full border-box transition-all duration-500 linear lg:px-16 md:px-20 px-8 py-4 bg-white">
    <div class="navbar-1-1" style="font-family: 'quicksand', sans-serif">
        <div class=" mx-auto flex flex-row items-center justify-between">

            <div class="flex w-2/4 justify-beetween">
                {{-- <a href="{{ route('index') }}" class="flex items-center"> --}}
                {{-- <img src="{{ asset('assets/images/logo.png') }}" alt="" class="ml-3"> --}}
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
                {{-- </a> --}}

                {{-- <svg viewBox="0 0 1350 600" id="svg">
                    <text x="50%" y="50%" fill="" text-anchor="middle">
                        UwhCamp
                    </text>
                </svg> --}}
                <div class="hidden lg:flex lg:items-center lg:w-auto w-full lg:ml-auto lg:mr-auto flex-wrap items-center text-base justify-center"
                    id="menu">
                    <nav
                        class="lg:space-x-12 space-x-0 lg:flex items-center justify-between text-base pt-8 lg:pt-0 lg:space-y-0 space-y-6">

                        <a href="{{ route('index') }}"
                            class="block hover:text-gray-900 {{ request()->is('/') ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}">Home</a>

                        <a href="{{ route('explore.landing') }}"
                            class="block hover:text-gray-900 {{ $active === 'explore' ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}">Bootcamp</a>

                        <a href="{{ route('about') }}"
                            class="block hover:text-gray-900 {{ $active === 'about' ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}">About</a>
                        @auth

                            <hr class="block lg:hidden">

                            @can('admin')
                                <a href="{{ route('admin.dashboard.index') }}"
                                    class="block lg:hidden nav-link text-serv-text">My
                                    Dashboard</a>
                            @endcan

                            @can('mentor')
                                <a href="{{ route('mentor.dashboard.index') }}"
                                    class="block lg:hidden nav-link text-serv-text">My
                                    Dashboard</a>
                            @endcan

                            @can('member')
                                <a href="{{ route('member.dashboard.index') }}"
                                    class="block lg:hidden nav-link text-serv-text">My
                                    Dashboard</a>
                            @endcan



                            <a href="{{ route('logout') }}" class="block lg:hidden nav-link text-serv-text"
                                onclick="evnt.preventDefault(); document.getElementById('logout-form').submit();">Logout

                                <form action="{{ route('logout') }}" id="logout-form" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>

                            </a>

                        @endauth

                    </nav>
                </div>

            </div>

            {{-- mobile --}}
            @auth

                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <svg class=" w-6 h-6 text-gray-500 hover:text-green-500 " x-show="!showMenu" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="hidden mobile-menu">
                    <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
                    <nav style="z-index: 10"
                        class="fixed top-0 left-0 bottom-0 flex flex-col w-4/6 max-w-sm py-6 px-6 bg-white border-r overflow-y-auto">
                        <div class="flex justify-between mb-8">
                            <div style="margin-left: -25px">
                                <a class="bg-red-400" href="#">
                                    <div class="flex items-center pt-8 pl-5 space-x-2 border-t border-gray-100">

                                        @if (Auth::user()->profile_photo_path != null)
                                            @if (Auth::user()->profile_photo_path[0] == 'h')
                                                <img src="{{ Auth::user()->profile_photo_path }}" alt="Photo Profile"
                                                    class="inline ml-3 h-12 w-12 rounded-full">
                                            @else
                                                <img src="{{ asset('images/profile/' . Auth::user()->profile_photo_path) }}"
                                                    alt="Photo Profile" class="inline ml-3 h-12 w-12 rounded-full">
                                            @endif
                                        @else
                                            <img src="https://source.unsplash.com/MP0IUfwrn0A"
                                                class="inline ml-3 h-12 w-12 rounded-full" />
                                        @endif

                                        <div>
                                            <!--Author name-->
                                            <p class="font-semibold text-gray-900 text-md">{{ Auth::user()->name ?? '' }}
                                            </p>
                                            <p class="text-sm font-light text-serv-text">
                                                {{ Auth::user()->user_roles->name ?? '' }}
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                            <div>
                                <button class="navbar-close">
                                    <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <ul class="items-center mb-4">
                            <li>
                                @if (Auth::user()->user_role_id == 1)
                                    {{-- Admin --}}
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                                @elseif (Auth::user()->user_role_id == 2)
                                    {{-- Mentor --}}
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('mentor.dashboard.index') }}">Dashboard</a>
                                @elseif (Auth::user()->user_role_id == 3)
                                    {{-- User --}}
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('member.dashboard.index') }}">Dashboard</a>
                                @elseif (Auth::user()->user_role_id == 4)
                                    {{-- Tutor --}}
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="tutor.dashboard.index">Dashboard</a>
                                @endif
                            </li>
                            <li>
                                <a href="{{ route('explore.landing') }}"
                                    class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ $active === 'explore' ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}">Bootcamp</a>
                            </li>
                            <li>
                                <a href="{{ route('create') }}"
                                    class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ $active === 'explore' ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}">About</a>
                            </li>
                            <li>
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline {{ $active === 'explore' ? 'nav-link active font-medium' : 'nav-link text-serv-text' }}"
                                    href="{{ url('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout

                                    <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            @endauth
            {{-- mobile --}}

            @guest

                <div class="lg:flex lg:items-center lg:w-auto md:w:auto w-full  mob:menu" id="menu">
                    <button onclick="toggleModal('loginModal')"
                        class="text-serv-login1-text hover:text-serv-login1-text hover:bg-gray600 mx-5 hover:text-gray-900 items-center border-0 block lg:inline-block lg:py-3 lg:px-10 focus:outline-none rounded font-medium text-base mt-6 lg:mt-0">
                        Log In
                    </button>

                    <button onclick="toggleModal('registerModal')"
                        class="lg:bg-serv-services-bg hover:bg-gray600 text-serv-login-text items-center border-0 block lg:inline-block  lg:py-3 lg:px-10 focus:outline-none rounded font-medium text-base mt-6 lg:mt-0">
                        Sign Up
                    </button>

                </div>

            @endguest

            @auth

                <div @click.away="open = false" class="hidden lg:block relative" x-data="{ open: false }">

                    <button @click="open = !open"
                        class="flex flex-row items-center w-full px-4 py-2 mt-2 text-left     bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">

                        Halo, {{ Auth::user()->name }}

                        @if (Auth::user()->profile_photo_path != null)
                            @if (Auth::user()->profile_photo_path[0] == 'h')
                                <img src="{{ Auth::user()->profile_photo_path }}" alt="Photo Profile"
                                    class="inline ml-3 h-12 w-12 rounded-full">
                            @else
                                <img src="{{ asset('images/profile/' . Auth::user()->profile_photo_path) }}"
                                    alt="Photo Profile" class="inline ml-3 h-12 w-12 rounded-full">
                            @endif
                        @else
                            <img src="https://source.unsplash.com/MP0IUfwrn0A"
                                class="inline ml-3 h-12 w-12 rounded-full" />
                        @endif

                        {{-- @if (auth()->user()->first()->profile_photo_path != null)
                            <img src="{{ asset('assets/images/profile/' . auth()->user()->profile_photo_path) }}"
                                alt="" class="inline ml-3 h-12 w-12 rounded-full">
                        @else
                            <img class="inline ml-3 h-12 w-12 rounded-full"
                                src="{{ url('https://randomuser.me/api/portraits/men/1.jpg') }}" alt="">
                        @endif --}}

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

                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">

                            {{-- jika user id = 1 => admin, user id = 2 => mentor, user id = 4 => member --}}
                            @if (Auth::user()->user_role_id == 1)
                                {{-- Admin --}}
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 2)
                                {{-- Mentor --}}
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('mentor.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 3)
                                {{-- User --}}
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="{{ route('member.dashboard.index') }}">Dashboard</a>
                            @elseif (Auth::user()->user_role_id == 4)
                                {{-- Tutor --}}
                                <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="tutor.dashboard.index">Dashboard</a>
                            @endif
                            {{-- ~~~~~~~~~~~~~~~belum disettings ~~~~~~~~~~~~~~~~ --}}
                            {{-- @if (Auth::user()->user_role_id == 1)
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('admin.dashboard.index') }}">Dashboard</a>
                                @elseif (Auth::user()->user_role_id == 2)
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('mentor.dashboard.index') }}">Dashboard</a>
                                @elseif (Auth::user()->user_role_id == 4)
                                    <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                        href="{{ route('member.dashboard.index') }}">Dashboard</a>
                                @endif --}}
                            {{-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ --}}
                            {{-- jika user id = 1 => admin, user id = 2 => mentor, user id = 4 => member --}}

                            <a class="block px-4 py-2 mt-2 text-sm bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                href="{{ url('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout

                                <form action="{{ route('logout') }}" method="POST" id="logout-form"
                                    style="display: none;">
                                    @csrf
                                </form>

                            </a>

                        </div>
                    </div>
                </div>

            @endauth

        </div>
    </div>
</section>
