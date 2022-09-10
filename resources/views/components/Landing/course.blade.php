<a href="{{ route('detail.landing', $course->slug) }}" class="inline-block px-3">
    <div class="w-96 h-auto overflow-hidden md:p-5 p-4 bg-white hover:bg-gray-200 rounded-2xl inline-block mob:w100">
        <div class="flex items-center space-x-2 mb-6">

            <!--Author's profile photo-->
            @if ($course->user->profile_photo_path != null)
                <img src="{{ url(Storage::url($course->user->profile_photo_path)) }}" alt="photo freelancer" loading="lazy"
                    class="w-14 h-14 object-cover rounded-full mr-1">
            @else
                <img class="w-14 h-14 object-cover object-center rounded-full mr-1"
                    src="{{ url('https://randomuser.me/api/portraits/men/1.jpg') }}" alt="random user" />
            @endif

            <div>
                <!--Author name-->
                <p class="text-gray-900 font-semibold text-lg">{{ $course->user->name ?? '' }}</p>
                <p class="text-serv-text font-light text-md">{{ $course->user->user_roles->name ?? '' }}</p>
            </div>

        </div>

        {{-- thumbnail image --}}

        @if ($course->image != null)
            <img src="{{ asset('images/course/thumbnail/' . $course->image) }}" alt="Thumbnail Course" loading="lazy"
                class="w-full h-26 object-cover rounded-2xl ">
        @else
            <img src="{{ url('https://via.placeholder.com/640x360') }}" alt="Thumbnail Course" loading="lazy"
                class="w-full h-26 object-cover rounded-2xl ">
        @endif

        <h1 class="font-semibold text-gray-900 text-lg mt-1 leading-normal py-4">
            {{ $course->name ?? '' }}
        </h1>
        <p class=" text-gray-900 text-sm pb-4 mt-1 leading-normal">
            {{ $course->note ?? '' }}
        </p>
        <!--Description-->
        <div class="max-w-full flex">
            @forelse ($bintang as $key => $r)

                @for ($i = 0; $i < 5; $i++)
                    <svg class="cursor-pointer block w-6 h-6 @if ($i < $r) text-yellow-400 @else text-gray-500 @endif"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                    </svg>
                @endfor
                <span class="ml-4">{{ $ratings[$course->id] }}</span>

            @empty
            @endforelse
            {{-- @include('components.Landing.rating') --}}
        </div>

        <div class="text-center mt-5 flex justify-between w-full">
            <span class="text-serv-text mr-3 inline-flex items-center leading-none text-md py-1 ">
                Price starts from:
            </span>
            <span class="text-serv-button inline-flex items-center leading-none text-md font-semibold">
                Rp. {{ number_format($course->price) ?? '' }}
            </span>
        </div>
    </div>
</a>
