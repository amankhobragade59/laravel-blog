<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
            <p>{{ $post->body }}</p>
            <p class="text-sm text-gray-500 mt-2">By {{ $post->author->name }}</p>

            @auth
                @if(auth()->id() === $post->user_id)
                    <div class="mt-2 flex space-x-2">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        {{-- Comments --}}
        <div class="mt-6">
            <h3 class="font-semibold text-lg mb-2">Comments</h3>

            @foreach($post->comments as $comment)
                <div class="border-b p-2 flex justify-between items-center">
                    <div>
                        <p>{{ $comment->content }}</p>
                        <p class="text-sm text-gray-500">By {{ $comment->author->name }}</p>
                    </div>
                    @if(auth()->id() === $comment->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('comments.edit', $comment) }}" class="text-yellow-500">Edit</a>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Delete comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach

            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" class="w-full border p-2 rounded" placeholder="Add a comment" required></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600">Add Comment</button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
