<x-app-layout>
    <div >
        <main >
            <div class="flex justify-center mb-10 pt-10">
                <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" class="w-96">
                    @csrf
                    @method("PUT")
                    <h1 class="text-center text-2xl font-semibold mb-3">Modifier un produit</h1>
                    <div class="flex-col">
                        <div class="mb-3 w-96">
                            <fieldset>
                                <legend>Categories</legend>
                                @if (!empty($categories) && count($categories) > 0)
                                    <div class="flex justify-evenly flex-wrap">
                                        @foreach ($categories as $category)
                                            <div>
                                                <input type="checkbox" id="cat-{{ $category->id }}" name="categories[]" value="{{ $category->id }}" @if (in_array($category->id, $idCategories)) checked @endif />
                                                <label for="cat-{{ $category->id }}">{{ $category->categorie }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </fieldset>
                        </div>
                        <div class="mb-3 w-96">
                            <label class="block mb-1.5" for="name">Nom</label>
                            <input class="text-black w-96" type="text" name="name" id="name" value="{{$product->name}}">
                        </div>
                        <div class="mb-3 w-96">
                            <label class="block mb-1.5" for="description">Description</label>
                            <input class="text-black w-96" type="text" name="description" id="description" value="{{$product->description}}">
                        </div>
                        <div class="mb-3 w-96">
                            <label class="block mb-1.5" for="price">Prix</label>
                            <input class="text-black w-96" name="price" id="price" value="{{$product->price}}">
                        </div>
                        <div class="mb-3 w-96">
                            <label class="block mb-1.5" for="Stock">Stock</label>
                            <input class="text-black w-96" name="stock" id="stock" value="{{$product->stock}}">
                        </div>
                        <div class="mb-3 w-96">
                            <label class="block mb-1.5" for="image">Photo</label>
                            <input type="file" name="image" id="image">
                        </div>
                        <input
                            class="text-white bg-purple-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-base px-5 py-2 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 cursor-pointer dark:focus:ring-purple-900"
                            type="submit" value="Modifier">
                    </div>
                </form>
            </div>
        </main>
        @include('layouts.front.footer')
    </div>
</x-app-layout>
