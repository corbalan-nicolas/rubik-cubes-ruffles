<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function verifier() {
        return $this->belongsTo(User::class, 'verifier_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
}
