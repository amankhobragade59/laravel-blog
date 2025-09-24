<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Posts') }}
            </h2>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add Post
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($posts->count())
                    <ul class="space-y-4">
                        @foreach($posts as $post)
                            <li class="border p-4 rounded hover:bg-gray-50 dark:hover:bg-gray-700">
                                <a href="{{ route('posts.show', $post) }}" class="font-semibold text-lg">{{ $post->title }}</a>
                                <p class="text-gray-600 dark:text-gray-300 mt-1">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>
                                <p class="text-sm text-gray-500 mt-1">By {{ $post->author->name }}</p>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-4">{{ $posts->links() }}</div>
                @else
                    <p class="text-gray-600 dark:text-gray-300">No posts available yet.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
