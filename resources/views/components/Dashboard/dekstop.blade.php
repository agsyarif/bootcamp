<!-- Desktop sidebar -->
<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white md:block" aria-label="aside">
    <div class="text-serv-bg">

        <a class="" href="{{ route('index') }}">
            <img src="{{ asset('/assets/images/logo.png') }}" alt="" class="object-center mx-auto my-4 ">
        </a>

        <div class="flex items-center pt-8 pl-5 space-x-2 border-t border-gray-100">

            @if (Auth::user()->profile_photo_path != null)

                @if (Auth::user()->profile_photo_path[0] == 'h')
                    <img src="{{ Auth::user()->profile_photo_path }}" alt="Photo Profile"
                        class="inline ml-3 h-12 w-12 rounded-full">
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
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800 "
                        href="{{ route('admin.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                {{-- mentor --}}
                <li class="relative px-6 py-3">
                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/mentor-management') ||
                        request()->is('admin/mentor-management/*') ||
                        request()->is('admin/*/mentor-management') ||
                        request()->is('admin/*/mentor-management/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-medium text-gray-800 transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('admin.mentor-management.index') }}">
                        <i class="fa fa-user-tie fa-lg"></i>
                        <!-- Active Icons -->

                        <span class="ml-3">Mentor Management</span>

                    </a>
                </li>

                {{-- all member --}}
                <li class="relative px-6 py-3">
                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
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
                        <!-- Active Icons -->

                        <span class="ml-3">Member Management</span>

                    </a>
                </li>

                {{-- Transaksi --}}
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
                        <!-- Active Icons -->

                        <span class="ml-3">Transaksi</span>
                        {{-- <span class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">{{ auth()->user()->order_freelancer()->count() }}</span> --}}

                    </a>
                </li>

                {{-- Course --}}
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
                        <span class="ml-3">Course</span>

                    </a>
                </li>

                {{-- role --}}
                <li class="relative px-6 py-3">
                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/role') ||
                        request()->is('admin/role/*') ||
                        request()->is('admin/*/role') ||
                        request()->is('admin/*/role/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="#">
                        <i class="fa fa-bars fa-lg"></i>
                        <!-- Active Icons -->

                        <span class="ml-3">Role Management</span>

                    </a>
                </li>

                {{-- menu --}}
                <li class="relative px-6 py-3">
                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('admin/menu') ||
                        request()->is('admin/menu/*') ||
                        request()->is('admin/*/menu') ||
                        request()->is('admin/*/menu/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="#">
                        <i class="fa fa-ellipsis fa-lg"></i>
                        <!-- Active Icons -->

                        <span class="ml-3">Menu Management</span>

                    </a>
                </li>

                {{-- profil --}}
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
                        {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect width="24" height="24" fill="white" />
                            <circle cx="10.5" cy="5.5" r="2.75" stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M3.75 18.2581C3.75 14.6638 6.66376 11.75 10.2581 11.75H11.7419C15.3362 11.75 18.25 14.6638 18.25 18.2581C18.25 18.8059 17.8059 19.25 17.2581 19.25H4.74194C4.1941 19.25 3.75 18.8059 3.75 18.2581Z"
                                stroke="#082431" stroke-width="1.5" />
                            <path
                                d="M17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981L17.9314 19.9848C17.715 20.3596 17.383 20.6541 16.985 20.8241L15.4217 21.4919C15.3603 21.518 15.2911 21.478 15.2831 21.4119L15.0797 19.7241C15.028 19.2944 15.117 18.8596 15.3333 18.4848L17 15.5981L17.75 14.299Z"
                                fill="white" />
                            <path
                                d="M17 15.5981L15.3333 18.4848C15.117 18.8596 15.028 19.2944 15.0797 19.7241L15.2831 21.4119C15.2911 21.478 15.3603 21.518 15.4217 21.4919L16.985 20.8241C17.383 20.6541 17.715 20.3596 17.9314 19.9848L19.5981 17.0981M17 15.5981L17.75 14.299C18.1642 13.5816 19.0816 13.3358 19.799 13.75V13.75C20.5165 14.1642 20.7623 15.0816 20.3481 15.799L19.5981 17.0981M17 15.5981L19.5981 17.0981"
                                stroke="#082431" stroke-width="1.5" />
                        </svg> --}}
                        <span class="ml-4">My Profile</span>
                    </a>
                </li>

                {{-- Activity Log --}}
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

                {{-- logout --}}
                <li class="relative px-6 py-3 flex">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ url('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>
                        <span class="ml-5">Logout</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf
                        </form>

                    </a>
                </li>
            </ul>
        @elsecan('isMentor')
            <ul class="mt-6">

                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('mentor/dashboard') ||
                        request()->is('mentor/dashboard/*') ||
                        request()->is('mentor/*/dashboard') ||
                        request()->is('mentor/*/dashboard/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-3">Dashboard</span>
                    </a>
                    </a>
                </li>

                {{-- Course --}}
                <li class="relative px-6 py-3">
                    @if (request()->is('mentor/course') ||
                        request()->is('mentor/course/*') ||
                        request()->is('mentor/*/course') ||
                        request()->is('mentor/*/course/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.course.index') }}">
                        <i class="fa fa-book fa-lg"></i>
                        <!-- Active Icons -->

                        <span class="ml-5">My Course</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green900 rounded-full bg-serv-green-badge">{{ $courses }}</span>
                    </a>

                </li>

                {{-- exam --}}
                <li class="relative px-6 py-3">
                    @if (request()->is('mentor/exam') ||
                        request()->is('mentor/exam/*') ||
                        request()->is('mentor/*/exam') ||
                        request()->is('mentor/*/exam/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.exam.index') }}">
                        <i class="fa fa-clipboard-question fa-lg"></i>

                        <span class="ml-5">My Exam</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green900 rounded-full bg-serv-green-badge">{{ $exam->count() }}</span>
                    </a>

                </li>

                {{-- profil --}}
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

                {{-- Activity Log --}}
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

                {{-- log out --}}
                <li class="relative px-6 py-3 flex">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ url('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>
                        <span class="ml-5">Logout</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf
                        </form>

                    </a>
                </li>
            </ul>
        @elsecan('isMember')
            <ul>
                {{-- Dashboard --}}
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/dashboard') ||
                        request()->is('member/dashboard/*') ||
                        request()->is('member/*/dashboard') ||
                        request()->is('member/*/dashboard/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('member.dashboard.index') }}">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>

                </li>

                {{-- Progress Belajar --}}
                <li class="relative px-6 py-3">
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

                {{-- My Course --}}
                <li class="relative px-6 py-3">
                    @if (request()->is('member/course') ||
                        request()->is('member/*/*') ||
                        request()->is('member/course/*') ||
                        request()->is('member/*/course') ||
                        request()->is('member/*/course/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @else
                    @endif
                    <a class="inline-flex items-center w-full text-sm font-medium text-gray-800 transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('member.course.index') }}">
                        <i class="fa fa-book fa-lg"></i>

                        <!-- Active Icons -->

                        <span class="ml-4">My Course</span>
                        <span
                            class="inline-flex items-center justify-center px-3 py-2 ml-auto text-xs font-bold leading-none text-green-500 rounded-full bg-serv-green-badge">
                            {{ $courses }}
                        </span>
                    </a>

                </li>

                {{-- My Profile / settings --}}
                <li class="relative px-6 py-3">

                    {{-- membuat kondisi aktif pada menu yang sedang dipilih --}}
                    @if (request()->is('member/profil') ||
                        request()->is('member/profil/*') ||
                        request()->is('member/*/profil') ||
                        request()->is('member/*/profil/*'))
                        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
                            aria-hidden="true"></span>
                    @endif

                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ route('mentor.profile.index') }}">
                        <i class="fa fa-user-gear fa-lg"></i>
                        <span class="ml-4">My Profile</span>
                    </a>
                </li>

                {{-- logout --}}
                <li class="relative px-6 py-3 flex">
                    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800"
                        href="{{ url('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-regular fas fa-right-from-bracket fa-lg"></i>
                        <span class="ml-5">Logout</span>

                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                            @csrf
                        </form>

                    </a>
                </li>
            </ul>
        @endcan

    </div>
</aside>
