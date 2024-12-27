<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 gap-2 text-gray-900 dark:text-gray-100">
                    <div class="flex rounded overflow-hidden shadow-lg my-4 border-gray-100 dark:border-gray-700 border">
                        <img class="w-1/3 object-cover" src="{{ $course->image }}" alt="{{ $course->title }}">
                        <div class="px-6 py-4 w-full">
                            <form action="{{ route('courses.update', $course->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Title:</label>
                                    <input type="text" name="title" id="title" value="{{ $course->title }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="price" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Price:</label>
                                    <input type="text" name="price" id="price" value="{{ $course->price }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-500 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Description:</label>
                                    <textarea rows="6" name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-500 leading-tight focus:outline-none focus:shadow-outline">{{ $course->description }}</textarea>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>