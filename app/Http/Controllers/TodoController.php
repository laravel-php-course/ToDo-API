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
    //TODO add try catch to all methods
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
        $todo = $this->repository->create($request->all());

        return $this->success('todo created', new TodoResource($todo));
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo , Request $request)
    {
        return $this->success('ok', new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest  $request, Todo $todo)
    {
        $todo->user_id = $request->input('user_id', 1);
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->status = $request->input('status', 'todo');

        $todo->save();

        return $this->success('ok', new TodoResource($todo));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return $this->success("todo {$todo->id} deleted");
    }
}
