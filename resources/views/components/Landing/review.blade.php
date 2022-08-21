<div class="flex border border-serv-testimonial-border rounded-lg mb-4">
    <!--horizantil margin is just for display-->
    <div class="flex items-start px-4 py-6">
        <div class="relative w-10 h-10 mr-3 rounded-full md:block">
            @if ($rating->user->profile_photo_url != null)
                @if ($rating->user->profile_photo_url[0] == 'h')
                    <img src="{{ $rating->user->profile_photo_url }}" alt="Photo Profile"
                        class="absolute object-cover w-full h-full rounded-full">
                @else
                    <img src="{{ asset('assets/images/profile/' . $rating->user->profile_photo_url) }}"
                        alt="Photo Profile" class="absolute object-cover w-full h-full rounded-full">
                @endif
            @else
                <img class="absolute object-cover w-full h-full rounded-full" src="{{ asset('assets/images/logo.png') }}"
                    alt="" loading="lazy" />
            @endif
            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
            </div>
        </div>
        {{-- <img class="w-16 h-16 rounded-full object-cover mr-4"
            src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
            alt="avatar"> --}}

        <div class="w-full">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-medium text-serv-bg my-1">{{ $rating->user->name }}</h2>
            </div>
            <p class="text-md flex">
                @for ($i = 0; $i < 5; $i++)
                    <svg class="cursor-pointer block w-5 h-5 @if ($i < $rating->rating) text-yellow-400 @else text-gray-500 @endif"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                    </svg>
                @endfor
            </p>
            <p class="mt-3 text-gray-700 text-md leading-8">
                {{ $rating->comment }}
            </p>
            <div class="mt-4 flex items-center">
                <div class="flex mr-2 text-serv-text text-md">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.3 3.3a1 1 0 0 1 1.4 1.4l1.6 5a1 1 0 0 1-.2.9l-.3.3a1 1 0 0 1-1.4 0l-5-1.6a1 1 0 0 1-.9-.2l-.3-.3a1 1 0 0 1 0-1.4l1.6-5a1 1 0 0 1 .2-.9l.3-.3zm-4.8.7a1 1 0 0 1 1.4 1.4l1.6 5a1 1 0 0 1-.2.9l-.3.3a1 1 0 0 1-1.4 0l-5-1.6a1 1 0 0 1-.9-.2l-.3-.3a1 1 0 0 1 0-1.4l1.6-5a1 1 0 0 1 .2-.9l.3-.3z" />
                    </svg>
                    <span class="text-gray-700">{{ \Carbon\Carbon::parse($rating->created_at)->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
