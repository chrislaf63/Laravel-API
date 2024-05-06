<x-app-layout>
    <div class="font-sans antialiased min-h-screen bg-gray-200 text-black">
        <div class="flex justify-center mb-10 pt-10">
            <form method="post" action="{{ route('user.update', $user->id) }}" class="w-96">
                @csrf
                @method("put")
                <h1 class="text-center text-2xl font-semibold mb-3">Modifier un utilisateur</h1>
                <div class="flex-col">
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="name">Nom de l'utilisateur</x-label>
                        <x-input class="text-black w-96" type="text" name="name" id="name" value="{{ $user->name }}"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="email">Email</x-label>
                        <x-input class="text-black w-96" type="email" name="email" id="email" value="{{ $user->email }}"></x-input>
                    </div>
                    <input
                        class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 cursor-pointer dark:focus:ring-purple-900"
                        type="submit" value="Envoyer">
                </div>
            </form>
        </div>
        @include('layouts.front.footer')
    </div>
</x-app-layout>
