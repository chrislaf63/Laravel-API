<x-app-layout>
    <form action="" method="post">
        @csrf
        @method('post')
        <label for="key">Entrez votre clé d'accès</label>
        <input type="text" name="key" id="key">
        <button type="submit">Soumettre</button>
    </form>
</x-app-layout>
