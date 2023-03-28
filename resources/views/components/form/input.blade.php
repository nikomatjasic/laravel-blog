@props(['name', 'type' => 'text', 'description' => ''])
<x-form.field>
    <x-form.label name="{{ $name }}"></x-form.label>
    <div class="flex">
        @if($description)
            <x-form.description>
                {{ $description }}
            </x-form.description>
        @endif
        <input {{ $attributes->merge(['class' => 'rounded-lg border border-gray-300 py-3 px-4 w-full']) }}
               type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $name }}"
            {{ $attributes(['value' => old($name)]) }}
        >
    </div>
    <x-form.error name="{{ $name }}"></x-form.error>
</x-form.field>
