@props(['name', 'type' => 'text', 'label' => ''])
<x-form.field.group {{ $attributes->merge(['class' => 'field--' . $name]) }}>
    @if($label !== false)
        <x-form.label />
    @endif
    <input class="rounded-lg border border-gray-300 py-3 px-4 w-full"
           type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $name }}"
           {{ $attributes(['value' => old($name)]) }}
    >
    <x-form.error.message />
</x-form.field.group>
