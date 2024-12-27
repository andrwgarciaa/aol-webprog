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
                    <div class="flex flex-col gap-4 rounded overflow-hidden shadow-lg my-4 ">
                        @foreach ($orders as $order)
                        <a href="{{ route('courses.show', $order->id) }}">
                            <div>
                                <div class="p-4 bg-white dark:bg-gray-900 rounded-lg shadow-md">
                                    <h3 class="text-lg font-semibold">{{ $order->title }}</h3>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $order->description }}</p>
                                    @if (auth()->user()->user_role_id == 3)
                                    <div class="mt-4">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Order Date: {{ $order->updated_at }}</span>
                                    </div>
                                    <div class="mt-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Status: {{ $order->status ?? ""}}</span>
                                    </div>
                                    @elseif (auth()->user()->user_role_id == 2)
                                    <div class="mt-4">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Purchases count: {{ $order->purchases_count ?? '' }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>