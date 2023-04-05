<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="font-bold text-2xl">Sign in!</h1>
            <form method="POST" action="/sessions" class="mt-7 space-y-3">
                @csrf
                 <x-form.field.input name="email" type="email" autocomplete="username"/>
                 <x-form.field.input name="password" type="password" autocomplete="new-password"/>
                 <x-form.button class="mt-4"/>
                <x-form.error.list :errors="$errors->all()" />
            </form>
        </main>
    </section>
</x-layout>
