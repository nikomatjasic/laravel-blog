<x-layout>
    <x-setting heading="Edit post: {{ $post->title }}">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="old('title', $post->title)"></x-form.input>
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file"
                                  :value="old('thumbnail', $post->thumbnail)"></x-form.input>
                </div>
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="body">
                {{ old('body', $post->body) }}
            </x-form.textarea>
            <x-form.textarea name="excerpt">
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>
            <x-form.field>
                <x-form.label name="Published"></x-form.label>
                <x-form.description>
                    Check to publish
                </x-form.description>
                <input type="checkbox" value="1" name="is_published" {{ $post->is_published ? 'checked' : null }} />
                <x-form.error name="is_published"></x-form.error>
            </x-form.field>
            <x-form.field>
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category_id">
                    @php
                        $categories = \App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) === $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <x-form.error name="category"></x-form.error>
            </x-form.field>
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>