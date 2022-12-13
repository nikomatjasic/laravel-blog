@props(['name', 'type' => 'text', 'description' => ''])
<x-form.field>
    <x-form.label name="{{ $name }}"></x-form.label>
    <div class="flex">
        <x-form.description>
            {{ $description }}
        </x-form.description>
        <input {{ $attributes->merge(['class' => 'border border-gray-400 p-2']) }}
               type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $name }}"
            {{ $attributes(['value' => old($name)]) }}
        >
    </div>
    <x-form.error name="{{ $name }}"></x-form.error>
</x-form.field>
