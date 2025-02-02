@props(['collections', 'headers', 'keys', 'isAction', 'actions'])

<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="py-3 px-6">
                No
            </th>

            @foreach (json_decode($headers) as $col)
                <th scope="col" class="py-3 px-6">
                    {{ $col }}
                </th>
            @endforeach

            @if ($isAction == 'true')
                <th scope="col" class="py-3 px-6">
                    Aksi
                </th>
            @endif
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6" class="text-center">
                <div wire:loading.block wire:target="search" class="alert alert-warning"
                    role="alert">
                    Sedang mencari data...
                </div>
            </td>
        </tr>
        <div wire:loading.remove wire:target="search">
            @forelse (json_decode($collections) as $key => $men)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                    <td class="py-4 px-6">
                        {{ $loop->iteration }}
                    </td>

                    @foreach (json_decode($keys) as $col)
                        @php
                            $value = data_get($men, $col);
                        @endphp

                        @if (is_array($value) || is_object($value))
                            @if ($value != null)
                                <td class="py-4 px-6">
                                    @foreach ($value as $item)
                                        <li>
                                            {{ $item->name ?? '-' }}
                                        </li>
                                    @endforeach
                                </td>
                            @else
                                <td class="py-4 px-6">
                                    -
                                </td>
                            @endif
                        @else
                            <td class="py-4 px-6">
                                {{ $men->$col ?? '-' }}
                            </td>
                        @endif
                    @endforeach


                    {{$slot}}

                    @if ($isAction == 'true')
                        <td class="py-4 px-6 flex gap-2">

                            @foreach (json_decode($actions) as $action)
                                <x-table.action
                                    route='{{$action->route}}'
                                    idRoute='{{$men->id}}'
                                    icon='{{$action->icon}}'
                                    color='{{$action->color}}'
                                />
                            @endforeach

                        </td>
                    @endif

                </tr>
            @empty
            @endforelse
        </div>
    </tbody>
</table>
