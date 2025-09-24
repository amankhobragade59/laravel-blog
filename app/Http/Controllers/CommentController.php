<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added!');
    }

    public function edit(Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);

        $request->validate([
            'content' => 'required|string'
        ]);

        $comment->update([
            'content' => $request->content
        ]);

        return redirect()->route('posts.show', $comment->post)->with('success', 'Comment updated!');
    }

    public function destroy(Comment $comment)
    {
        abort_if($comment->user_id !== auth()->id(), 403);
        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)->with('success', 'Comment deleted!');
    }
}
