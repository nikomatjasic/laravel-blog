<x-layout>
    <x-panel class="max-w-sm mx-auto">
        <section>
            <h1 class="text-lg mb-6 font-bold">
                Create new post
            </h1>
            <form method="POST" action="/admin/posts/create" enctype="multipart/form-data">
                @csrf
                <x-form.input name="title"></x-form.input>
                <x-form.input name="thumbnail" type="file"></x-form.input>
                <x-form.textarea name="body"></x-form.textarea>
                <x-form.textarea name="excerpt"></x-form.textarea>
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
                <x-form.button>Publish</x-form.button>
            </form>
        </section>
    </x-panel>
</x-layout>
