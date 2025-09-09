<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

}
