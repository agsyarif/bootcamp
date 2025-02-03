<!-- Desktop sidebar -->
<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white md:block" aria-label="aside">
    <div class="text-serv-bg">

        <a class="" href="{{ route('index') }}">
            <img src="{{ asset('/assets/images/oncoding.png') }}" alt="" class="object-center mx-auto my-4 ">
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
                <img src="{{asset('assets/images/user.png')}}" class="inline ml-2 h-10 w-10 rounded-full" />
            @endif

            <div>
                <!--Author name-->
                <p class="font-semibold text-gray-900 text-md">{{ Auth::user()->name ?? '' }}</p>
                <p class="text-sm font-light text-serv-text">
                    {{ Auth::user()->user_roles->name ?? '' }}
                </p>
            </div>

        </div>

        <p>

        </p>

        <p class="hidden">
            {{ $role = Str::lower(Auth::user()->roles()->pluck('name')->first()) }}
        </p>

        <ul class="mt-6">
            @can('dashboard')
                <x-menu.menu route='dashboard.index' role='{{$role}}' path='dashboard' icon='fa-house' name='Dashboard' />
            @endcan

                @can('mentor-management')
                    <x-menu.menu route='mentor-management.index' role='admin' path='mentor-management' icon='fa-user-tie' name='Mentor Management' />
                @endcan

                @can('member-management')
                    <x-menu.menu route='member-management.index' role='admin' path='member-management' icon='fa-user-graduate' name='Member Management' />
                @endcan

                @can('transaction')
                    <x-menu.menu route='transaction.index' role='admin' path='transaction' icon='fa-wallet' name='Transaction' />
                @endcan

                @can('course')
                    <x-menu.menu route='courses.index' role='{{$role}}' path='courses' icon='fa-book' name='Course' />
                @endcan

                @can('exam')
                    <x-menu.menu route='exam.index' role='mentor' path='exam' icon='fa-clipboard-question' name='Exam Course' />
                @endcan

                @can('role-management')
                    {{-- role route perlu diganti --}}
                    <x-menu.menu route='role.index' role='admin' path='role' icon='fa-bars' name='Role Management' />
                @endcan

                @can('permission')
                    <x-menu.menu route='permission.index' role='admin' path='permission' icon='fa-ellipsis' name='Menu Management' />
                @endcan

                @can('log-activity')
                    <x-menu.menu route='permission.index' role='{{$role}}' path='log-actifity' icon='fa-chalkboard-teacher' name='Log Activity' />
                @endcan

                @can('progress')
                    <x-menu.menu route='member.progress.index' role='member' path='progress' icon='fa-bars-progress' name='Progress Belajar' />
                @endcan

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

    </div>
</aside>
