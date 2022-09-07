<div>

    <div class="flex justify-between">
        <div>

            <h2 class="mb-1 text-xl font-semibold">
                Top Reviews
            </h2>
            <p class="text-sm text-gray-400">
                {{ $comments->count() }} Total Reviews
            </p>

        </div>
        {{-- <div class="self-end hover:translate-x-2 transition transform">
            <a href="{{ route('admin.comment.create') }}" class="text-sm text-gray-400 hover:text-gray-800">
                Comment
                <i class="fas fa-arrow-right"></i>
            </a>
        </div> --}}
    </div>

    <table class="w-full" aria-label="Table">

        <thead>
            <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                <th class="py-4" scope=""></th>
                <th class="py-4" scope=""></th>
            </tr>
        </thead>

        <tbody class="bg-white">
            @forelse ($comments as $comment)
                <tr class="text-gray-700">

                    <td class="w-64 px-1 py-2">
                        <div class="flex items-center text-sm">

                            <div class="relative w-10 h-10 mr-3 rounded-full md:block">

                                @if ($comment->user->profile_photo_url != null)
                                    @if ($comment->user->profile_photo_url[0] == 'h')
                                        <img src="{{ $comment->user->profile_photo_url }}" alt="Photo Profile"
                                            class="absolute object-cover w-full h-full rounded-full">
                                    @else
                                        <img src="{{ asset('assets/images/profile/' . $comment->user->profile_photo_url) }}"
                                            alt="Photo Profile"
                                            class="absolute object-cover w-full h-full rounded-full">
                                    @endif
                                @else
                                    <img class="absolute object-cover w-full h-full rounded-full"
                                        src="{{ asset('assets/images/logo.png') }}" alt="" loading="lazy" />
                                @endif

                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                </div>

                            </div>

                            <div>
                                <p class="font-medium text-black">{{ '@' . $comment->user->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p>
                            </div>

                        </div>
                    </td>

                    <td class="px-1 py-5 text-xs flex text-right item-end">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="cursor-pointer block w-6 h-6 @if ($i < $comment->rating) text-yellow-400 @else text-gray-500 @endif"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                        @endfor
                    </td>
                </tr>

            @empty
            @endforelse
        </tbody>
    </table>

</div>
