@props(['route', 'role', 'path', 'icon', 'name', 'isActive' => Auth::user()->active_status])

<li class="relative px-6 py-3">

    @if (request()->is("$role/$path") ||
        request()->is("$role/$path/*") ||
        request()->is("$role/*/$path") ||
        request()->is("$role/*/$path/*"))

        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg"
            aria-hidden="true"></span>
    @endif

    <a class="inline-flex items-center w-full text-sm font-light transition-colors duration-150 hover:text-gray-800 justify-between {{$isActive == 0 && $path != 'dashboard' ? 'disabledLink' : ''}}"
        href="{{ route($route) }}">
        <div>
            <i class="fa-solid {{$icon}} fa-lg"></i>
            <span class="ml-4">{{$name}}</span>
        </div>
        @if ($isActive == 0 && $path != 'dashboard')
            <i class="fa-solid fa-lock fa-lg" style="color: rgb(137, 5, 5)"></i>
        @endif
    </a>
</li>
