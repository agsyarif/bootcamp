@props(['h2', 'description', 'label', 'img', 'url'])

<div class="flex h-screen">
    <div class="m-auto text-center">
        <img src="{{ asset($img) }}" alt="" class="w-48 mx-auto">
        <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
            {{$h2}}
        </h2>
        <p class="text-sm text-gray-400">
            {{$description}}
        </p>

        <div class="relative mt-0 md:mt-6">
            <a href="{{ route($url) }}"
                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-button">
                {{$label}}
            </a>
        </div>
    </div>
</div>
