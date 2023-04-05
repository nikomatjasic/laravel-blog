@props(['name', 'label' => ''])
<x-form.field.group class="field--{{ $name }}">
    @if($label !== false)
        <x-form.label />
    @endif
    <textarea {{ $attributes->merge(['class' => 'rounded-lg border border-gray-300 py-3 px-4 w-full']) }}
              name="{{ $name }}"
              id="{{ $name }}"
    >{{ $slot }}</textarea>
    <x-form.error.message />
</x-form.field.group>
