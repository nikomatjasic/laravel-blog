@auth
    <x-panel>
        <form method="POST" action="/posts/{{ $post->slug }}/comments" class="space-y-6">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/?p={{ auth()->id() }}"
                     alt=""
                     style="width: 40px;"
                     class="rounded-xl rounded-full"
                >
                <h2 class="ml-2">Want to participate?</h2>
            </header>

            <x-form.textarea name="body"
                             rows="10"
                             class="w-full text-sm focus:outline-none focus:ring"
                             placeholder="Add you comment here"
                             :label="false"
            ></x-form.textarea>
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
