<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Todo;

class Category extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->belongsToMany(Todo::class, 'todo_relations')->withTimestamps();
    }
}
