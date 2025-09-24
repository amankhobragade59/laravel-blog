<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" required
                        class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Body</label>
                    <textarea name="body" rows="6" required
                        class="w-full border px-3 py-2 rounded">{{ old('body', $post->body) }}</textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
