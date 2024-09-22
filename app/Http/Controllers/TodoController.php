<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('ok', TodoResource::collection(Todo::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTodoRequest $request)
    {
       return Todo::newTodo($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return $this->success('ok', new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo) //TODO ceate cusstome validation //done
    {
       return $todo->updateTodo($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response("Todo ID: {$todo->id} deleted");
    }
}
