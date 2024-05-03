<x-app-layout>
    <div class="flex flex-col gap-3 items-center">
        @foreach($products as $product)
            <div class="flex w-1/2 mt-5 bg-gray-300 border-2">
                <div class="w-1/4">
                    <img src="{{ asset('photos/'. $product->image) }}" alt="">
                </div>
                <div class="w-3/4 pl-5">
                    <p class="text-2xl"> {{ $product->name }}</p>
                    <span> Catégorie : </span>
                    @foreach($product->categories as $category)
                        <span> {{ $category->categorie }} - </span>
                    @endforeach
                    <p> {{ $product->description }}</p>
                    <p> Prix : {{ $product->price }} €</p>
                    <div class="flex justify-star">
                        <div class="mt-2.5 ml-3">
                            <a href="{{ route('product.edit', $product->id) }}">
                                <button
                                    class="text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-base px-5 py-2 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                                    Edit
                                </button>
                            </a>
                        </div>
                        <div class="mt-2.5">
                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base px-5 py-2 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
