<x-app-layout>
    <div class="font-sans antialiased min-h-screen bg-gray-200 text-black">
        <h1 class="text-center text-2xl font-semibold mb-3 pt-4">Gestion des catégories</h1>
        <div class="flex justify-evenly mb-10 pt-10">
            <form method="post" action="{{ route('category.store') }}" class="w-96">
                @csrf
                @method("post")

                <h2 class="text-center text-xl mb-3">Créer une nouvelle catégorie</h2>
                <div class="flex-col">
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="categorie">Nom de la catégorie</x-label>
                        <x-input class="text-black w-96" type="text" name="categorie" id="categorie"></x-input>
                    </div>
                    <input
                        class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 cursor-pointer dark:focus:ring-purple-900"
                        type="submit" value="Envoyer">
                </div>
            </form>
            <div class="flex flex-col">
                <h2 class="text-center text-xl mb-3">Gestion des catégories</h2>
                @foreach($categories as $categorie)
                    <div class="bg-gray-50 px-4 mb-4 rounded-lg border border-black">
                        <div class="text-center text-lg mb-2">
                            <p>{{ $categorie->categorie }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('category.edit', $categorie->id) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 cursor-pointer dark:focus:ring-blue-900">Modifier</a>
                            <form method="post" action="{{ route('category.destroy', $categorie->id) }}">
                                @csrf
                                @method("delete")
                                <input
                                    class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-red-600 dark:hover:bg-red-700 cursor-pointer dark:focus:ring-red-900"
                                    type="submit" value="Supprimer">
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @include('layouts.front.footer')
    </div>
</x-app-layout>
