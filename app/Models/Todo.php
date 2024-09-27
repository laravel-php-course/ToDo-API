<?php

namespace App\Models;

use App\Http\Resources\TodoResource;
use App\Trait\ApiResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Todo extends Model
{
    use HasFactory ,ApiResponse;
    protected $fillable = ['title', 'status', 'body', 'user_id', 'schedule_time'];

    public static function newTodo(Request $request)
    {
       return Todo::create([
           'user_id' => $request->input('user_id', 1),
           'title' => $request->input('title'),
           'body' => $request->input('body'),
           'status' => $request->input('status', 'todo'),
           'schedule_time' => $request->input('schedule_time', null)
       ]);
    }

    public function updateTodo(Request $request)
    {
        $this->title = $request->title;
        $this->body = $request->body;
        $this->status = $request->status;
        $this->schedule_time = $request->schedule_time;
        $this->save();
        return new TodoResource($this);
    }
}
