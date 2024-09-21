<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
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
        try {
            $todos = Todo::all();
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
        $todo = Todo::create([
            'user_id' => $request->input('user_id', 1),
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'status'  => $request->input('status', 'todo')
        ]);

        return response()->json($todo);
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
    public function update(Request $request, Todo $todo) //TODO ceate cusstome validation
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'string',
            'status'=> 'in:todo,in-progress,done',
        ]);
        $todo->title = $request->title;
        $todo->body = $request->body;
        $todo->status = $request->status;
        $todo->save();

        return response()->json($todo);
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
