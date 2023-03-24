<x-layout>
    <x-setting heading="Publish new post">
        <form method="POST" action="/admin/posts/create" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <x-form.input name="title"/>
            <x-form.input name="thumbnail" type="file"/>
            <x-form.textarea name="body"/>
            <x-form.textarea name="excerpt"/>
            <x-form.input name="published"
                          type="checkbox"
                          description="Check to publish"
                          class="p-2 pr-6 ml-4"
            />
            <x-form.field>
                <x-form.label name="category"/>
                <select name="category_id" id="category_id" class="border border-gray-500 p-3 rounded-sm">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category"/>
            </x-form.field>
            <x-form.button type="submit">Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
