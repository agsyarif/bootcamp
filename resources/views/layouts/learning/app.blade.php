<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>

    @include('includes.Dashboard.meta')

    <title>@yield('title') | UWHcamp</title>

    @stack('before-style')

    @include('includes.Dashboard.learning.style')

    @stack('after-style')

    @livewireStyles

</head>

<body class="antialiased">
    <div class="flex h-screen bg-serv-services-bg" :class="{ 'overflow-hidden': isSideMenuOpen }">

        {{-- @include('components.dashboard.dekstop') --}}

        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 flex items-end bg-black bg-opacity-50 z-1 sm:items-center sm:justify-center"></div>



        {{-- @include('components.dashboard.mobile') --}}

        <div class="flex flex-col flex-1 w-full">

            @include('components.Dashboard.header_learning')

            @include('sweetalert::alert')

            @yield('content')

        </div>

    </div>

    @stack('before-script')

    @include('includes.Dashboard.learning.script')

    @stack('after-script')

    @livewireScripts
</body>

</html>
