<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Todo;

use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function todos()
    {
        return $this->belongsToMany(Todo::class, 'todo_relations')->withTimestamps();
    }
}
