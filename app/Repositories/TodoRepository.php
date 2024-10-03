<?php

namespace App\Repositories;

use App\Http\Requests\UpdateTodoRequest;
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

    public function update( $request,  $todo)
    {
        $todo->user_id = $request->input('user_id', 1);
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->status = $request->input('status', 'todo');

        $todo->save();
    }
}
