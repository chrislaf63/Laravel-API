<x-app-layout>
    <div class="font-sans antialiased min-h-screen bg-gray-200 text-black">
        <div class="flex justify-center mb-10 pt-10">
            <form method="post" action="{{ route('user.store') }}" class="w-96">
                @csrf
                @method("post")
                <h1 class="text-center text-2xl font-semibold mb-3">Créer un utilisateur</h1>
                <div class="flex-col">
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="name">Nom de l'utilisateur</x-label>
                        <x-input class="text-black w-96" type="text" name="name" id="name"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="email">Email</x-label>
                        <x-input class="text-black w-96" type="email" name="email" id="email"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="password">Mot de passe</x-label>
                        <x-input class="text-black w-96" type="password" name="password" id="password"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="password_confirmation">Confirmation du mot de passe</x-label>
                        <x-input class="text-black w-96" type="password" name="password_confirmation" id="password_confirmation"></x-input>
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
