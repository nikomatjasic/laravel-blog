<div x-data="{ show: false }" @click.away="show = false" class="relative">
   <div @click="show = ! show">
       {{ $trigger }}
   </div>

    <div x-show="show" class="py-2 absolute bg-gray-50 mt-1 rounded-xl w-48 z-50 overflow-auto max-h-52"
         style="display: none;">
        {{ $slot }}
    </div>
</div>
