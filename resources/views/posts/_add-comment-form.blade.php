@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/?p={{ auth()->id() }}"
                     alt=""
                     style="width: 40px;"
                     class="rounded-xl rounded-full"
                >
                <h2 class="ml-2">Want to participate?</h2>
            </header>

            <div>
            <textarea
                name="body"
                id="body"
                class="w-full text-sm focus:outline-none focus:ring border border-gray-200 p-2 mt-4"
                rows="10"
                placeholder="Add you comment here"
            >{{ old('body') }}
            </textarea>
                @error('body')
                <p class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div>
                <x-form.button>
                    Post
                </x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p>
        <a href="/register" class="text-blue-300 hover:underline">
            Register
        </a>
        or
        <a href="/login" class="text-blue-300 hover:underline">
            Log in
        </a>
        to leave a comment.
    </p>
@endauth
