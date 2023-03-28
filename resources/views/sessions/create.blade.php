<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <x-form.header>Log In!</x-form.header>
            <form method="POST" action="/sessions" class="mt-7 space-y-3">
                @csrf
                 <x-form.input name="email" type="email" autocomplete="username"/>
                 <x-form.input name="password" type="password" autocomplete="new-password"/>

                 <x-form.button class="mt-4">Log In</x-form.button>
                <x-form.list-errors :errors="$errors->all()" />
            </form>
        </main>
    </section>
</x-layout>
