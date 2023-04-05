<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="font-bold text-2xl">Activate user</h1>
            <form method="POST" action="/activate-user/{{ $hash }}" class="mt-7 space-y-3">
                @csrf
                <x-form.field.input name="password"/>
                <x-form.field.input name="password_confirmation"/>
                <x-form.button class="mt-4">Activate user</x-form.button>
                <x-form.error.list :errors="$errors->all()" />
            </form>
        </main>
    </section>
</x-layout>
