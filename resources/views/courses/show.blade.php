<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 gap-2 text-gray-900 dark:text-gray-100">
                    <div class="flex rounded overflow-hidden shadow-lg my-4 border-gray-100 dark:border-gray-700 border">
                        <img class="w-1/3 object-cover" src="{{ $course->image }}" alt="{{ $course->title }}">
                        <div class="px-6 py-4">
                            <p class="font-bold text-2xl mb-2">{{ $course->title }}</p>
                            <p class="font-bold text-xl mb-2">taught by <span class="italic">{{ $course->lecturer_name }}</span></p>
                            <p class="mb-2 text-gray-700 dark:text-gray-300 text-base">
                                {{ $course->description }}
                            </p>
                            @auth
                            @if (Auth::user()->user_role_id == 2 && Auth::user()->id == $course->lecturer_id)
                            <a href="{{ route('courses.edit', $course->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit course
                            </a>
                            @elseif (Auth::user()->user_role_id == 3)
                            @if (property_exists($course, 'status') && $course->status != NULL && $course->status_id != 3)
                            <p>Status: {{$course->status}}</p>
                            @if ($course->status_id == 1)
                            <a href="{{ route('orders.cart') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold mt-1 py-2 px-4 rounded">
                                Go to Cart
                            </a>
                            @elseif ($course->status_id == 2)
                            <form action="{{ route('courses.start', $course->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-1 py-2 px-4 rounded">
                                    Start Lesson
                                </button>
                            </form>
                            @elseif ($course->status_id == 4)
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-1 py-2 px-4 rounded">
                                Continue Lesson
                            </a>
                            @endif
                            @else
                            <div class="flex gap-4 pt-4 pb-2">
                                <span class="inline-block border-gray-200 border dark:bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500">Rp{{ number_format($course->price, 0, ',', '.') }}</span>
                                <span class="border-gray-200 border dark:bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-500 flex items-center">
                                    <svg class="w-4 h-4 text-yellow-300 dark:text-gray-500 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <span>
                                        {{$course->rating}}/5
                                    </span>
                                </span>
                            </div>
                            <form action="{{ route('orders.store', $course->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Add to Cart
                                </button>
                            </form>
                            @endif
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>