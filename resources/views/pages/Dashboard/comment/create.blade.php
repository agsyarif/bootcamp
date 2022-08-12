{{-- @can('isAdmin')
    @extends('layouts.app')
@elsecan('isMember') --}}
{{-- @extends('layouts.learning.app') --}}
{{-- @endcan --}}

@extends('layouts.learning.app')

@section('title', 'Dashboard')

@section('content')

    <main class="h-full overflow-y-auto bg-dark">
        {{-- <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">

                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Add Your Comment
                    </h2>

                    <p class="text-sm text-gray-400">
                        Upload the Member you provide
                    </p>

                </div>
            </div>
        </div> --}}

        <!-- breadcrumb -->
        <nav class="mx-10 mt-8 text-sm bg-dark" aria-label="Breadcrumb">
            <ol class="inline-flex p-0 list-none">

                <li class="flex items-center">
                    <a href="{{ route('member.dashboard.index') }}" class="text-gray-400">Dashboard</a>
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                    {{-- roure riderect kembali ke halaman sebelumnya --}}
                </li>
                <li class="flex items-center">
                    <a href="{{ route('member.course.show', [$course->id]) }}" class="text-gray-400">{{ $course->name }}</a>
                    {{-- <a href="{{ route('member.course.show', []) }}" class="text-gray-400">Dashboard</a> --}}
                    <svg class="w-3 h-3 mx-3 text-gray-400 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>

                <li class="flex items-center">
                    <a href="#" class="font-medium">Comment</a>
                </li>

            </ol>
        </nav>

        @livewire('comment', [$course->id])

    </main>

@endsection
