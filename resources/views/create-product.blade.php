<x-app-layout>
    <div class="font-sans antialiased min-h-screen bg-gray-200 text-black">
        <div class="flex justify-center mb-10 pt-10">
            <form method="post" action="{{ route('product.store') }}" class="w-96" enctype="multipart/form-data">
                @csrf
                @method("post")
                <h1 class="text-center text-2xl font-semibold mb-3">Créer un nouveau produit</h1>
                <div class="flex-col">
                    <div class="mb-3 w-96">

                        <fieldset>
                            <legend>Categories</legend>
                            <div class="flex justify-evenly flex-wrap">
                                @if (!empty($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <div class="ml-2">
                                            <x-input type="checkbox" id="cat-{{ $category->id }}" name="categories[]" value="{{ $category->id }}"></x-input>
                                            <label for="cat-{{ $category->id }}">{{ $category->categorie }}</label>

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </fieldset>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="name">Nom du produit</x-label>
                        <x-input class="text-black w-96" type="text" name="name" id="name"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="description">Description</x-label>
                        <x-input class="text-black w-96" type="text" name="description" id="description"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="price">Prix</x-label>
                        <x-input type="text" class="text-black w-96" name="price" id="price"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="stock">
                            Stock disponible
                        </x-label>
                        <x-input type="text" class="text-black w-96" name="stock" id="stock"></x-input>
                    </div>
                    <div class="mb-3 w-96">
                        <x-label class="block mb-1.5" for="image">Photo</x-label>
                        <x-input type="file" name="image" id="image"></x-input>
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
