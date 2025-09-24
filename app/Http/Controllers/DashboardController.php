<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{

    /**
     * Show dashboard with all posts.
     */
    public function index()
    {
        // Fetch latest posts with author and comments (with comment authors)
        $posts = Post::with(['author', 'comments.author'])
                     ->latest()
                     ->paginate(10);

        // Pass posts to dashboard view
        return view('dashboard', compact('posts'));
    }
}
