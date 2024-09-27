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
    public function show(Todo $todo , Request $request)
    {
        // return response()->json($todo);
        return $this->success('ok', new TodoResource($todo));
    }

    /**
     * Update the specified resource in storage.
     */
/**
 * Update the specified resource in storage.
 */
public function update(UpdateTodoRequest  $request, Todo $todo) //TODO create custom validation
{


    // $this->update([
    //     "title" => request()->has("title") ? request()->title : $this->title,
    //     "body" => request()->has("body") ? request()->body : $this->body
    // ])
    $todo->user_id = $request->input('user_id', 1);
    $todo->title = $request->input('title');
    $todo->body = $request->input('body');
    $todo->status = $request->input('status', 'todo');

    // Save the updated Todo instance
    $todo->save();

    // Return a JSON response with the updated Todo
    // return response()->json($todo);
    return $this->success('ok', new TodoResource($todo));

}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json(["message"=>'todo deleted']);
        // return response("Todo ID: {$todo->id} deleted");
    }
}
