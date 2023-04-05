@auth
    <div>
        <form method="POST" action="/posts/{{ $post->slug }}/comments" class="space-y-6">
            @csrf
            <header class="flex items-center">
                <img src="https://i.pravatar.cc/?p={{ auth()->id() }}"
                     style="width: 40px;"
                     class="rounded-full"
                >
                <h2 class="ml-2">Want to participate?</h2>
            </header>

            <x-form.field.textarea
                name="body"
                rows="10"
                class="w-full text-sm focus:outline-none focus:ring"
                placeholder="Add you comment here"
                :label="false"
                required
            />
            <x-form.button>Post</x-form.button>
        </form>
    </div>
@else
    <p>
        <a href="/register" class="text-blue-500 hover:underline">Register</a>
        or
        <a href="/login" class="text-blue-500 hover:underline">Sign in</a>
        to leave a comment.
    </p>
@endauth
