<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">
                Register
            </h1>
            <form method="POST" action="/activate-user/{{ $hash }}" class="mt-10">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-cs text-gray-700"
                           for="password"
                    >
                        Password
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password"
                           id="password"
                           required
                    >
                    @error('password')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-cs text-gray-700"
                           for="password_confirm"
                    >
                        Confirm password
                    </label>
                    <input class="border border-gray-400 p-2 w-full"
                           type="password"
                           name="password_confirmation"
                           id="password_confirmation"
                           required
                    >
                    @error('password_confirm')
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Activate user
                    </button>
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
