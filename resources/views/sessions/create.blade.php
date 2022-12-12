<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">
                Log In!
            </h1>

            <form method="POST" action="/sessions" class="mt-10">
                @csrf
                <div class="mb-6">
                    <x-form.input name="email" type="email" autocomplete="username"></x-form.input>
                </div>
                <div class="mb-6">
                    <x-form.input name="password" type="password" autocomplete="new-password"></x-form.input>
                </div>

                <div class="mb-6">
                    <x-form.button>Log In</x-form.button>
                </div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-red-400 text-xs"> {{ $error  }} </li>
                    @endforeach
                </ul>
            </form>
        </main>
    </section>
</x-layout>
