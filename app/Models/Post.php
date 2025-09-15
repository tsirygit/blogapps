<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'content',
    ];

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class)->where('like', true);
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(Like::class)->where('like', false);
    }
    
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
