<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function update(User $user, Comment $comment)
    { return $user->id===$comment->user_id; }

    public function delete(User $user, Comment $comment)
    { return $user->id===$comment->user_id; }
}
