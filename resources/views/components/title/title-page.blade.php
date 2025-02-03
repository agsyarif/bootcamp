@props(['label', 'description'])

<div class="container mx-auto">
    <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
        <div class="col-span-8">

            <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                {{$label}}
            </h2>

            <p class="text-sm text-gray-400">
                {{$description}}
            </p>
        </div>

        <div class="col-span-4 lg:text-right"></div>
    </div>
</div>
