<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Status;

class Todo extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'todo_relations')->withTimestamps();
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status', 'id');
    }
}
