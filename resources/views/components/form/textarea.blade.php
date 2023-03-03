@props(['name', 'label' => true])
<x-form.field>
    @if($label)
        <x-form.label name="{{ $name }}"></x-form.label>
    @endif
    <textarea {{ $attributes->merge(['class' => 'border border-gray-500 p-3 rounded-sm w-full']) }}
              name="{{ $name }}"
              id="{{ $name }}"
              placeholder="{{ $attributes->get('placeholder') }}"
              rows="{{ $attributes->get('rows') }}"
              required
    >{{ $slot }}</textarea>
    <x-form.error name="{{ $name }}"></x-form.error>
</x-form.field>
