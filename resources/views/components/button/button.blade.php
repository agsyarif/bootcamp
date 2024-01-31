@props(['route', 'viewName'])

<a href="{{ route($route) }}"
    class="inline-block px-4 py-2 mt-2 text-left text-white rounded-lg bg-serv-button">
        {{$viewName}}
</a>
