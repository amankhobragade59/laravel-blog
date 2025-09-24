<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add Post
            </a>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="border-b p-4 mb-4">
                        {{-- Post Title --}}
                        <a href="{{ route('posts.show', $post) }}" class="font-semibold text-lg hover:underline">
                            {{ $post->title }}
                        </a>
                        {{-- Post Body --}}
                        <p class="text-gray-600 dark:text-gray-300 mt-1">{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>
                        {{-- Author --}}
                        <p class="text-sm text-gray-500 mt-1">By {{ $post->author->name }}</p>

                        {{-- Edit/Delete for Post Owner --}}
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

                        {{-- Comments --}}
                        <div class="mt-4">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-200">Comments:</h4>

                            @if($post->comments->count())
                                @foreach($post->comments as $comment)
                                    <div class="flex justify-between items-start border-b py-2">
                                        <div>
                                            <p>{{ $comment->content }}</p>
                                            <p class="text-sm text-gray-500">By {{ $comment->author->name }}</p>
                                        </div>

                                        {{-- Edit/Delete for Comment Owner --}}
                                        @auth
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
                                        @endauth
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 mt-1">No comments yet.</p>
                            @endif

                            {{-- Add Comment Form --}}
                            @auth
                                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-2">
                                    @csrf
                                    <textarea name="content" class="w-full border p-2 rounded" placeholder="Add a comment" required></textarea>
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 mt-2 rounded hover:bg-blue-600">Add Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <p class="text-gray-600 dark:text-gray-300">No posts available. Click "Add Post" to create one!</p>
            @endif
        </div>
    </div>
</x-app-layout>
