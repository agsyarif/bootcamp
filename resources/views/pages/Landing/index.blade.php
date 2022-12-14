@extends('layouts.front')

@section('title', 'HOME')



@section('content')

    <!-- top -->
    <div class="hero-bg">
        <!-- header -->

        <!-- hero -->
        <div class="hero">
            <div class="flex lg:pb-20 lg:px-16 md:px-16 sm:px-8 px-8 pb-16 lg:pb-20 lg:pl-24 md:pl-16 sm:pl-8 mx-auto">
                <!-- Left Column -->
                <div
                    class="mob:text-center lg:flex-grow lg:w-1/2 flex flex-col lg:items-start lg:text-left mb-3 md:mb-12 lg:mb-0 items-center">
                    <h1 class="mob:font1 lg:leading-normal sm:text-4xl lg:text-5xl text-3xl mb-5 font-semibold lg:mt-20">
                        Bangun Karir Impianmu <br class="lg:block hidden">
                        Bersama UWHcamp
                    </h1>

                    {{-- mobile --}}
                    <div class="hero-mobile sm:hidden">
                        <img src="{{ asset('images/assets/images/hero1.png') }}" class="mob:size">
                    </div>
                    {{-- mobile --}}

                    <p
                        class="mb-10 mob:text-center mob:p-style text-lg leading-relaxed text-serv-text font-light tracking-wide lg:mb-18 ">
                        UWHcamp mentransformasi para pemula <br class="lg:block hidden">
                        untuk menjadi digital talent terbaik di Indonesia <br class="lg:block hidden">
                        yang siap bekerja.
                    </p>

                    <div
                        class="md:flex contents items-center mx-auto lg:mx-0 lg:flex justify-center lg:space-x-8 md:space-x-2 space-x-0">
                        <a href="{{ route('explore.landing') }}"
                            class="bg-serv-button text-white text-lg font-semibold py-4 px-12 my-2 rounded">
                            Get Started
                        </a>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="w-full lg:w-1/2 text-center mob:hidden lg:justify-start justify-center pr-0">
                    {{-- <img src="{{ asset('images/hero1.png') }}" style="width: 32rem; height: 32rem;"> --}}
                    {{-- pada webhosting --}}
                    <img src="{{ asset('images/assets/images/hero1.png') }}" alt=""
                        style="width: 32rem; height: 32rem;">
                </div>
            </div>

        </div>
    </div>

    <!-- content -->
    <div class="content">

        <!-- services -->
        <div class="bg-serv-services-bg">
            <div class="pt-16 pb-16 lg:pb-20 lg:pl-24 md:pl-16 sm:pl-8 mx-auto mob:p20">

                <div class="mob:text-center flex flex-col w-full mb-5">
                    <h1 class="mob:font1 md:text-4xl text-3xl tracking-wider font-semibold mb-5 text-medium-black">
                        Keunggulan Belajar Di UWHcamp</h1>
                </div>

                {{-- <div class="flex lg:flex-row flex-col items-center pb-1 "> --}}
                <div class="grid sm:grid-cols-2 gap-4 mob:col-grid1">

                    {{-- <div class=""> --}}
                    <div class="p-6 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
                        <img src="{{ asset('/assets/images/ic_globe.png') }}" alt="" class="inline mr-3 h-14 w-14">
                        <a href="#">
                            <h5 class="mob:font2 mb-2 text-2xl font-semibold tracking-tight text-gray-900">
                                Relevan
                                Skillset</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 text-gray-400"> Kurikulum kami dibuat dan
                            selalu
                            disesuaikan dengan kebutuhan industri teknologi
                            masa kini. </p>
                    </div>
                    <div class="p-6 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
                        <img src="{{ asset('/assets/images/ic_globe-1.png') }}" alt=""
                            class="inline mr-3 h-14 w-14">
                        <a href="#">
                            <h5 class="mob:font2 mb-2 text-2xl font-semibold tracking-tight text-gray-900">
                                Growth
                                Mindset
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 text-gray-400"> Siswa kami selalu
                            dibimbing dan
                            dituntut memiliki Growth Mindset yang berguna untuk
                            peningkatan karir di masa depan.</p>
                    </div>
                    {{-- </div> --}}

                    {{-- <div class=""> --}}
                    <div class="p-6 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
                        <img src="{{ asset('/assets/images/ic_globe-3.png') }}" alt=""
                            class="inline mr-3 h-14 w-14">
                        <a href="#">
                            <h5 class="mob:font2 mb-2 text-2xl font-semibold tracking-tight text-gray-900">
                                Coding
                                Bootcamp</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 text-gray-400">Siswa akan difokuskan untuk
                            belajar
                            menjadi Full Stack Developer atau Data Scientist
                            di program Full Time.
                        </p>
                    </div>
                    <div class="p-6 max-w-lg bg-white rounded-lg border border-gray-200 shadow-md">
                        <img src="{{ asset('/assets/images/ic_globe-2.png') }}" alt=""
                            class="inline mr-3 h-14 w-14">
                        <a href="#">
                            <h5 class="mob:font2 mb-2 text-2xl font-semibold tracking-tight text-gray400">
                                Hiring
                                Partner</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-500 text-gray-400 ">Kami bekerjasama dengan lebih
                            dari
                            350 Hiring Partner yang siap merekrut lulusan
                            Full Time Program kami.
                        </p>
                    </div>
                    {{-- </div> --}}

                </div>

                {{-- </div> --}}
            </div>
        </div>

        <!-- services -->
        <div class="overflow-hidden">
            <div class="pt-16 lg:pb-20 lg:pl-24 md:pl-16 sm:pl-8 pl-8 mx-auto">
                <div class="mob:text-center flex flex-col w-full">
                    <h1 class="mob:font1 md:text-4xl text-3xl tracking-wider font-semibold mb-10 text-medium-black">
                        Pilih Jalur Belajar Kamu</h2>
                </div>

                <div class="flex overflow-x-scroll pb-10 hide-scroll-bar dragscroll -mx-3">
                    <div class="flex flex-nowrap">
                        {{-- @forelse ($services as $service)
                            @include('components.landing.service')

                        @empty --}}
                        {{-- empty --}}
                        {{-- @endforelse --}}
                    </div>

                </div>
            </div>
        </div>

        <!-- call to action -->
        <div class="bg-serv-services-bg py-10 lg:py-24 flex lg:flex-row flex-col items-center cta-bg">
            <!-- Left Column -->
            <div class="w-full lg:w-1/2 text-center justify-center flex lg:mb-0 mb-12">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" data-lity>
                    <img id="hero" src="{{ asset('/assets/images/video-placeholder.png') }}" alt=""
                        class="p-5" />
                </a>
            </div>
            <!-- Right Column -->
            <div class="lg:w-1/2 w-full flex flex-col lg:items-start items-center lg:text-left text-center mob:p20">
                <h1 class="mob:font1 md:text-4xl text-3xl font-semibold mb-10 lg:leading-normal text-medium-black">
                    Konsultasi dengan.
                    <br>
                    Representatif UWHcamp.
                </h1>

                <p class="text-lg leading-relaxed text-serv-text font-light mb-10 lg:mb-18">
                    Kami yang membantumu memilih,
                    <br class="lg:block hidden">
                    kamu yang menentukan. <br class="lg:block hidden">

                </p>

                <a href="https://wa.me/08885092116?text=Hi, Saya ingin bertanya tentang Bootcamp di UWHcamp ini??"
                    class="bg-serv-button px-10 py-4 text-base text-white font-semibold rounded cursor-pointer focus:outline-none tracking-wide">
                    Hubungi Kami
                </a>
            </div>
        </div>

        <!-- services -->
        <div class="overflow-hidden">
            <div class="pt-16 pb-16 lg:pb-20 lg:pl-24 md:pl-16 sm:pl-8 mx-auto">
                <div class="flex flex-col w-full text-center py-5">
                    <h1 class="mob:font1 md:text-4xl text-3xl tracking-wider font-semibold mb-10 text-medium-black">
                        Success Stories</h1>
                </div>

                <div class="flex overflow-x-scroll pb-10 hide-scroll-bar dragscroll -mx-3">
                    <div class="flex flex-nowrap">

                        {{-- <div class="inline-block px-5">
                            <div class="w-80 h-90 overflow-hidden md:p-5 p-4 bg-white rounded-md inline-block">
                                <div class="flex items-center space-x-2 mb-6">

                                    <img src="{{ asset('/assets/images/avatar/1.jpg') }}" alt="photo freelancer"
                                        loading="lazy" class="w-14 h-14 object-cover rounded-full mr-1">

                                    <div>
                                        <!--Author name-->
                                        <p class="text-gray-900 font-semibold text-lg">Saiful Anam</p>

                                        <p class="text-serv-text font-light text-md">
                                            Alumni Fullstack Developer
                                        </p>

                                    </div>
                                </div>

                                <div class="flex border border-serv-testimonial-border rounded-md mb-4">
                                    <!--horizantil margin is just for display-->
                                    <div class="flex items-start px-4 py-6">
                                        <div class="w-full">

                                            <p class="text-md">
                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    class="inline align-baseline" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.04894 0.927052C6.3483 0.0057416 7.6517 0.00574088 7.95106 0.927052L8.79611 3.52786C8.92999 3.93989 9.31394 4.21885 9.74717 4.21885H12.4818C13.4505 4.21885 13.8533 5.45846 13.0696 6.02786L10.8572 7.63525C10.5067 7.8899 10.3601 8.34127 10.494 8.75329L11.339 11.3541C11.6384 12.2754 10.5839 13.0415 9.80017 12.4721L7.58779 10.8647C7.2373 10.6101 6.7627 10.6101 6.41222 10.8647L4.19983 12.4721C3.41612 13.0415 2.36164 12.2754 2.66099 11.3541L3.50604 8.75329C3.63992 8.34127 3.49326 7.8899 3.14277 7.63525L0.930391 6.02787C0.146677 5.45846 0.549452 4.21885 1.51818 4.21885H4.25283C4.68606 4.21885 5.07001 3.93989 5.20389 3.52786L6.04894 0.927052Z"
                                                        fill="#FFBF47" />
                                                </svg>

                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    class="inline align-baseline" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.04894 0.927052C6.3483 0.0057416 7.6517 0.00574088 7.95106 0.927052L8.79611 3.52786C8.92999 3.93989 9.31394 4.21885 9.74717 4.21885H12.4818C13.4505 4.21885 13.8533 5.45846 13.0696 6.02786L10.8572 7.63525C10.5067 7.8899 10.3601 8.34127 10.494 8.75329L11.339 11.3541C11.6384 12.2754 10.5839 13.0415 9.80017 12.4721L7.58779 10.8647C7.2373 10.6101 6.7627 10.6101 6.41222 10.8647L4.19983 12.4721C3.41612 13.0415 2.36164 12.2754 2.66099 11.3541L3.50604 8.75329C3.63992 8.34127 3.49326 7.8899 3.14277 7.63525L0.930391 6.02787C0.146677 5.45846 0.549452 4.21885 1.51818 4.21885H4.25283C4.68606 4.21885 5.07001 3.93989 5.20389 3.52786L6.04894 0.927052Z"
                                                        fill="#FFBF47" />
                                                </svg>

                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    class="inline align-baseline" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.04894 0.927052C6.3483 0.0057416 7.6517 0.00574088 7.95106 0.927052L8.79611 3.52786C8.92999 3.93989 9.31394 4.21885 9.74717 4.21885H12.4818C13.4505 4.21885 13.8533 5.45846 13.0696 6.02786L10.8572 7.63525C10.5067 7.8899 10.3601 8.34127 10.494 8.75329L11.339 11.3541C11.6384 12.2754 10.5839 13.0415 9.80017 12.4721L7.58779 10.8647C7.2373 10.6101 6.7627 10.6101 6.41222 10.8647L4.19983 12.4721C3.41612 13.0415 2.36164 12.2754 2.66099 11.3541L3.50604 8.75329C3.63992 8.34127 3.49326 7.8899 3.14277 7.63525L0.930391 6.02787C0.146677 5.45846 0.549452 4.21885 1.51818 4.21885H4.25283C4.68606 4.21885 5.07001 3.93989 5.20389 3.52786L6.04894 0.927052Z"
                                                        fill="#FFBF47" />
                                                </svg>

                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    class="inline align-baseline" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.04894 0.927052C6.3483 0.0057416 7.6517 0.00574088 7.95106 0.927052L8.79611 3.52786C8.92999 3.93989 9.31394 4.21885 9.74717 4.21885H12.4818C13.4505 4.21885 13.8533 5.45846 13.0696 6.02786L10.8572 7.63525C10.5067 7.8899 10.3601 8.34127 10.494 8.75329L11.339 11.3541C11.6384 12.2754 10.5839 13.0415 9.80017 12.4721L7.58779 10.8647C7.2373 10.6101 6.7627 10.6101 6.41222 10.8647L4.19983 12.4721C3.41612 13.0415 2.36164 12.2754 2.66099 11.3541L3.50604 8.75329C3.63992 8.34127 3.49326 7.8899 3.14277 7.63525L0.930391 6.02787C0.146677 5.45846 0.549452 4.21885 1.51818 4.21885H4.25283C4.68606 4.21885 5.07001 3.93989 5.20389 3.52786L6.04894 0.927052Z"
                                                        fill="#FFBF47" />
                                                </svg>

                                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                                                    class="inline align-baseline" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.04894 0.927052C6.3483 0.0057416 7.6517 0.00574088 7.95106 0.927052L8.79611 3.52786C8.92999 3.93989 9.31394 4.21885 9.74717 4.21885H12.4818C13.4505 4.21885 13.8533 5.45846 13.0696 6.02786L10.8572 7.63525C10.5067 7.8899 10.3601 8.34127 10.494 8.75329L11.339 11.3541C11.6384 12.2754 10.5839 13.0415 9.80017 12.4721L7.58779 10.8647C7.2373 10.6101 6.7627 10.6101 6.41222 10.8647L4.19983 12.4721C3.41612 13.0415 2.36164 12.2754 2.66099 11.3541L3.50604 8.75329C3.63992 8.34127 3.49326 7.8899 3.14277 7.63525L0.930391 6.02787C0.146677 5.45846 0.549452 4.21885 1.51818 4.21885H4.25283C4.68606 4.21885 5.07001 3.93989 5.20389 3.52786L6.04894 0.927052Z"
                                                        fill="#FFBF47" />
                                                </svg>

                                                <span class="text-serv-yellow font-medium">5</span>
                                            </p>

                                            <p class="mt-3 text-gray-700 text-md leading-8">
                                                kelas yang mantap dan sangat jelas penjelasan flow alur nya sukses selalu
                                                UWHcamp!!!. ????
                                            </p>

                                            <div class="mt-4 flex items-center">
                                                <div class="flex mr-2 text-serv-text text-md">
                                                    Published 9 hours ago
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

@endsection
