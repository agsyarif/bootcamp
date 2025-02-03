@props(['route', 'id', 'image', 'name', 'level', 'user', 'role'])

<a href="{{ route($route, [$id]) }}" class="">
    <div
        class="flex flex-col justify-center px-4 py-4 mb-4 bg-white hover:bg-gray-300 rounded-xl max-h-10 min-h-10">
        <div>
            <div>

                @if ($image != null)
                    <img class="object-cover w-50 h-30 rounded"
                        src="{{ asset('storage/course/thumbnail/' . $image) }}"
                        alt="" loading="lazy" />
                @else
                    <img class="object-cover w-50 h-30 rounded"
                        src="{{ asset('/assets/images/online-learning.png') }}"
                        alt="" loading="lazy" />
                @endif
            </div>

            <p class="mt-5 text-xl font-semibold text-left text-gray-800">
                {{ $name ?? '' }}</p>

            <p class="text-base font-reguler text-left text-gray-400">
                {{ $level ?? '' }}</p>


            <p class="text-md text-left font-normal py-5 text-gray-800">
                {{ $user ?? '' }}<br class="hidden lg:block">
                <span
                    class="text-sm text-gray-500">{{ $role ?? '' }}</span>
            </p>

        </div>
    </div>
</a>
