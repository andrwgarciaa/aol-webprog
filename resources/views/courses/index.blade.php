<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot> -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 h-max p-6 gap-2 text-gray-900 dark:text-gray-100">
                    @foreach ($courses as $course)
                    <a href="{{ route('courses.show', $course->id) }}">
                        <div class="relative w-full h-full rounded overflow-hidden shadow-lg my-4 border-gray-100 dark:border-gray-700 border">
                            <img class="object-cover" src="{{ $course->image }}" alt="{{ $course->title }}">
                            <p class="font-bold text-lg p-4 mb-2">
                                <span class="block sm:hidden">{{ Str::limit($course->title, 30, '...') }}</span>
                                <span class="hidden sm:block md:hidden">{{ Str::limit($course->title, 20, '...') }}</span>
                                <span class="hidden md:block">{{ Str::limit($course->title, 25, '...') }}</span>
                            </p>
                            <div class=" right-2 bottom-2 px-4">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>