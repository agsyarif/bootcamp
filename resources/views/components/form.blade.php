@props(['for', 'forView', 'placeholder', 'type', 'name', 'id', 'isRequired', 'readonly' => false, 'value', 'label'])

<div class="col-span-6 sm:col-span-3">
    <label for="{{ $for }}" class="block mb-3 font-medium text-gray-700 text-md">
        {{ $forView }}
    </label>

    <input
        placeholder="{{ $placeholder }}"
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $id }}"
        autocomplete="{{ $name }}"
        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
        value="{{ $value ?? '' }}"
        {{ $isRequired ? 'required' : '' }}
        {{ $readonly ? 'readonly' : '' }}
    >

    @if ($errors->has($name))
        <p class="text-red-500 mb-3 text-sm">
            {{ $errors->first($name) }}
        </p>
    @endif
</div>
