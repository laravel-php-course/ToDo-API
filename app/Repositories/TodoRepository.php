<?php

namespace App\Repositories;

use App\Models\Todo;
use Request;

class TodoRepository
{
    public function getAllTodos()
    {
        return Todo::all();
    }

    public function create(array $data)
    {
        $todo = Todo::create([
            'user_id' => $data['user_id'],
            'title'   => $data['title'],
            'body'    => $data['body'],
            'status'  => $data['status'] ?? 'todo'
        ]);
        return $todo;
    }
}
