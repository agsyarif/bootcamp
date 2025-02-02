@props(['route', 'idRoute', 'icon', 'color'])

<a href="{{ route($route, $idRoute) }}"
    class="py-2 mt-2 {{$color}} whover:text-gray-800"
    >
    <i class="fa-regular {{$icon}}"></i>
</a>
