@aware(['name', 'label'])
<label class="block mb-2 text-sm" for="{{ $name }}">
    @php
        $text = clear_string($name);
        if (is_string($label)) {
          $text = $label;
        }
    @endphp
   {{ $text }}
</label>
