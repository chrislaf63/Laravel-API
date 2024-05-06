<x-app-layout>
    <div class="font-sans antialiased min-h-screen bg-gray-200 text-black">
        <h1 class="text-center text-2xl font-semibold mb-6 pt-4">Gestion des utilisateurs</h1>
        <div class="flex justify-center">
            <div class="mb-6">
            <a href="{{ route('user.create') }}"
               class="text-white font-semibold bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 cursor-pointer dark:focus:ring-purple-900">Créer un nouvel utilisateur</a>
            </div>
        </div>
        <div class="flex flex-wrap gap-4 justify-center">

            @foreach($users as $user)
                <div class="bg-gray-50 px-4  rounded-lg border border-black w-1/4">
                    <div class="text-lg mb-2">
                        <span class="font-bold">ID :</span><span> {{ $user->id }}</span>
                    </div>
                    <div class=" text-lg mb-2">
                        <p><span class="font-bold">Nom d'utilisateur : </span><span>{{ $user->name }}</span></p>
                    </div>
                    <div class="text-lg mb-2">
                        <p><span class="font-bold">Email : </span><span>{{ $user->email }}</span></p>
                    </div>
                    <div class="text-lg mb-2">
                        <p><span class="font-bold">Utilisateur crée le : </span><span>{{ $user->created_at }}</span></p>
                    </div>
                    <div class="text-lg mb-2">
                        <p><span class="font-bold">Modifié le : </span><span>{{ $user->updated_at }}</span></p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('user.edit', $user->id) }}"
                           class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 cursor-pointer dark:focus:ring-blue-900">Modifier</a>
                        <form method="post" action="{{ route('user.destroy', $user->id) }}">
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
</x-app-layout>
