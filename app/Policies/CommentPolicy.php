<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;

class CommentPolicy
{
    public function edit(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }

    public function destroy(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
