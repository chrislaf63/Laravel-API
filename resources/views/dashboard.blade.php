<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text text-3xl text-center mb-4 font-bold">API de gestion des produits</h1>
                <h2 class="text text-2xl text-center mb-4 font-bold">Bienvenue sur la console d'administration de votre API de gestion des produits</h2>
                <p class="pl-3">Votre API de gestion des produits vous permet, selon les permissions accordées de :</p>
                <ul class="ml-6 italic p-2">
                    <li>D'ajouter, modifier ou supprimer un utilisateur.</li>
                    <li>De consulter la liste des produits.</li>
                    <li>D'ajouter, modifier ou supprimer un produit.</li>
                    <li>D'ajouter, modifier ou supprimer une catégorie de produits.</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
