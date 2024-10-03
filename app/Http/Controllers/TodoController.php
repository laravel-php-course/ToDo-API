<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use App\Trait\ApiResponse;
use Illuminate\Http\Request;

class TodoController extends Controller
{

    use ApiResponse;
    private TodoRepository $repository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->repository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $todos = $this->repository->getAllTodos();
            return $this->success('ok', TodoResource::collection($todos));
        }
        catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTodoRequest $request)
    {
        try {
        $todo = $this->repository->create($request->all());
        return $this->success('todo created', new TodoResource($todo));
        }
        catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo , Request $request)
    {
        try {
        return $this->success('ok', new TodoResource($todo));
        }
        catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest  $request, Todo $todo)
    {
        try {

        $this->repository->update($request , $todo);
        return $this->success('ok', new TodoResource($todo));

        }
        catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        try {
        $todo->delete();

        return $this->success("todo {$todo->id} deleted");
        }
        catch (\Exception $exception) {
            return $this->error($exception->getMessage(), 500);
        }
    }
}
