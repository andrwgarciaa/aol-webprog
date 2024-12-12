<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 gap-2 text-gray-900 dark:text-gray-100">
                    <div class="flex rounded overflow-hidden shadow-lg my-4 border-gray-100 dark:border-gray-700 border">
                        <img class="w-1/3 object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                        <div class="px-6 py-4">
                            <p class="font-bold text-2xl mb-2">{{ $product->name }}</p>
                            <p class="font-bold text-xl mb-2">{{ $product->seller_name }}</p>
                            <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500">{{ $product->price }}</span>
                            </div>
                            @auth
                            @if (Auth::user()->user_role_id == 2 && Auth::user()->id == $product->seller_id)
                            <a href="{{ route('products.update', $product->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Product
                            </a>
                            @elseif (Auth::user()->user_role_id == 3)
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>