@props(['id', 'name', 'nameView', 'isRequired', 'collection'])

<div class="col-span-6 sm:col-span-3">

    <div class="flex justify-between items-center">
        <label for="{{$id}}" class="block mb-2 font-medium text-gray-700 text-md">
            {{$nameView}}
        </label>
        {{ $slot }}
    </div>

    <select id="{{$id}}" name="{{$name}}" autocomplete="{{$name}}"
        class="block w-full px-3 py-3 pr-10 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        {{$isRequired ? 'required' : ''}}>

        <option>{{$nameView}}</option>

        @foreach (json_decode($collection) as $col)
                <option value={{ $col->name }}>{{ $col->name }}</option>
        @endforeach

    </select>

    @if ($errors->has($name))
        <p class="text-red-500 mb-3 text-sm">
            {{ $errors->first($name) }}
        </p>
    @endif

</div>
