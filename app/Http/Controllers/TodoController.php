<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_data_in_todo_list =  Todo::all('todos');

        return response()->json($all_data_in_todo_list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function show(Todo $todo, Request $request )
    {
        $spcific_resource = Todo::where('user_id', '=',$request->input(1));

        return response()->json($spcific_resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //validation 

        $this->validate($request,[
            'title' => 'required',
            'status' => 'required',
            'body'=>'required',
            'schedule_time'=>'required'
        ]);

        $record = Todo::find(1,); 
        $record->update([  
            'title' => $request->title,  
            'status' => $request->status, 
            'body' => $request->body,
            'schedule_time' =>$request->schedule_time,
        ]);  

        return $record ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $deleting_row = Todo::where('user_id','=',1);
        return $deleting_row->delete();

        

    }
}
