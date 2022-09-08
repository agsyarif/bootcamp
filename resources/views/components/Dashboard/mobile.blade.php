<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-white md:hidden" x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu" aria-label="aside">
    <div class=" text-gray-500 dark:text-gray-400">

        <a class="ml-6" href="{{ route('index') }}">
            <img src="{{ asset('/assets/images/logo.png') }}" alt="" class="ml-6">
        </a>

        <div class="flex items-center pt-5 pl-5 mt-10 space-x-2 border-t border-gray-100">
            <!--Author's profile photo-->

            @if (Auth::user()->profile_photo_path != null)

                @if (Auth::user()->profile_photo_path[0] == 'h')
                    <img src="{{ Auth::user()->profile_photo_path }}" alt="Photo Profile"
                        class="rounded-full w-16 h-16">
                @else
                    <img src="{{ asset('images/profile/' . Auth::user()->profile_photo_path) }}" alt="Photo Profile"
                        class="inline ml-3 h-12 w-12 rounded-full">
                @endif
            @else
                <img src="https://source.unsplash.com/MP0IUfwrn0A" class="inline ml-3 h-12 w-12 rounded-full" />
            @endif

            <div>
                <!--Author name-->
                <p class="font-semibold text-gray-900 text-md">{{ Auth::user()->name ?? '' }}</p>
                <p class="text-sm font-light text-serv-text">
                    {{ Auth::user()->user_roles->name ?? '' }}
                </p>
            </div>

        </div>

        @can('isAdmin')
            <ul class="mt-6">
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/dashboard') ||
                        request()->is('admin/dashboard/*') ||
                        request()->is('admin/*/dashboard') ||
                        request()->is('admin/*/dashboard/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-medium text-gray-800 transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>

                </li>
            </ul>

            <ul>
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/mentor-management') ||
                        request()->is('admin/mentor-management/*') ||
                        request()->is('admin/*/mentor-management') ||
                        request()->is('admin/*/mentor-management/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.mentor-management.index') }}">
                        <i class="fa fa-user-tie fa-lg"></i>
                        <span class="ml-4">Mentor Management</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    @if (request()->is('admin/member-management') ||
                        request()->is('admin/member-management/*') ||
                        request()->is('admin/*/member-management') ||
                        request()->is('admin/*/member-management/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.member-management.index') }}">
                        <i class="fa fa-user-graduate fa-lg"></i>
                        <span class="ml-4">Member Managament</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/transaction') ||
                        request()->is('admin/transaction/*') ||
                        request()->is('admin/*/transaction') ||
                        request()->is('admin/*/transaction/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.transaction.index') }}">
                        <i class="fa fa-wallet fa-lg"></i>
                        <span class="ml-4">Transaksi</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/course') ||
                        request()->is('admin/course/*') ||
                        request()->is('admin/*/course') ||
                        request()->is('admin/*/course/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.course.index') }}">

                        <i class="fa fa-book fa-lg"></i>
                        <span class="ml-4">Course</span>
                    </a>
                </li>


                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/profil') ||
                        request()->is('admin/profil/*') ||
                        request()->is('admin/*/profil') ||
                        request()->is('admin/*/profil/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.profile.index') }}">
                        <i class="fa fa-user-gear fa-lg"></i>
                        <span class="ml-4">My Profile</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/activity') ||
                        request()->is('admin/activity/*') ||
                        request()->is('admin/*/activity') ||
                        request()->is('admin/*/activity/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="#">
                        <i class="fas fa-chalkboard-teacher fa-lg"></i>
                        <span class="ml-4">Log Activity</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>

                        <span class="ml-4">Log out</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        @endcan

        @can('isMentor')
            <ul class="mt-6">
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/dashboard') ||
                        request()->is('member/dashboard/*') ||
                        request()->is('member/*/dashboard') ||
                        request()->is('member/*/dashboard/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-medium text-gray-800 transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>

                </li>
            </ul>

            <ul>
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('mentor/course') ||
                        request()->is('mentor/course/*') ||
                        request()->is('mentor/*/course') ||
                        request()->is('mentor/*/course/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.course.index') }}">
                        <i class="fa fa-book fa-lg"></i>
                        <span class="ml-4">My Course</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">{{ $courses }}</span>

                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('mentor/exam') ||
                        request()->is('mentor/exam/*') ||
                        request()->is('mentor/*/exam') ||
                        request()->is('mentor/*/exam/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.exam.index') }}">
                        <i class="fa fa-clipboard-question fa-lg"></i>
                        <span class="ml-4">My Exam</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">{{ $exam->count() }}</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('mentor/profil') ||
                        request()->is('mentor/profil/*') ||
                        request()->is('mentor/*/profil') ||
                        request()->is('mentor/*/profil/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.profile.index') }}">
                        <i class="fa fa-user-gear fa-lg"></i>
                        <span class="ml-4">My Profile</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ url('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>
                        <span class="ml-4">Log out</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        @endcan

        @can('isMember')
            <ul class="mt-6">
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/dashboard') ||
                        request()->is('member/dashboard/*') ||
                        request()->is('member/*/dashboard') ||
                        request()->is('member/*/dashboard/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-medium text-gray-800 transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('member.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>

                </li>
            </ul>

            <ul>


                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/progress') ||
                        request()->is('member/Progress/*') ||
                        request()->is('member/*/progress') ||
                        request()->is('member/*/progress/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('member.progress.index') }}">
                        <i class="fa fa-bars-progress fa-lg"></i>
                        <span class="ml-4">Progress Belajar</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/course') ||
                        request()->is('member/*/*') ||
                        request()->is('member/course/*') ||
                        request()->is('member/*/course') ||
                        request()->is('member/*/course/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('member.course.index') }}">
                        <i class="fa fa-book fa-lg"></i>

                        <span class="ml-4">My Course</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">{{ $courses }}</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/profile') ||
                        request()->is('member/profile/*') ||
                        request()->is('member/*/profile') ||
                        request()->is('member/*/profile/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.profile.index') }}">
                        <i class="fa fa-user-gear fa-lg"></i>
                        <span class="ml-4">My Profile</span>
                    </a>
                </li>

                <li class="relative px-6 py-3">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>

                        <span class="ml-4">Log out</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf</form>
                    </a>
                </li>
            </ul>
        @endcan

    </div>
</aside>
