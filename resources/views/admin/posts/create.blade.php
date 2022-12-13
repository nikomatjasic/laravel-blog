<x-layout>
    <x-setting heading="Publish new post">
        <form method="POST" action="/admin/posts/create" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title"></x-form.input>
            <x-form.input name="thumbnail" type="file"></x-form.input>
            <x-form.textarea name="body"></x-form.textarea>
            <x-form.textarea name="excerpt"></x-form.textarea>
            <x-form.input name="published"
                          type="checkbox"
                          description="Check to publish"
                          class="p-2 pr-6 ml-4"
            ></x-form.input>
            <x-form.field>
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category_id">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </x-form.field>
            <x-form.button type="submit">Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
