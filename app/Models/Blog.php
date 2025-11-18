<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function verifier() {
        return $this->belongsTo(User::class, 'verifier_id');
    }

    public function likes() {
        return $this->belongsToMany(
            Blog::class,
            'likes',
        );
    }

    public function categories() {
        return $this->belongsToMany(
    Category::class,
    'blog_category',
        );
    }

    public function getCategoryIds(): array {
        return $this->categories->pluck('id')->all();
    }
}
