<x-form.field>
    <button {{ $attributes->merge(['class' => 'bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl'])  }}>
        {{ $slot }}
    </button>
</x-form.field>
