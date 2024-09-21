<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status', 'body', 'user_id', 'schedule_time'];

    public static function newTodo(Request $request)
    {
        Todo::create([
            'user_id' => $request->input('user_id', 1),
            'title'   => $request->input('title'),
            'body'    => $request->input('body'),
            'status'  => $request->input('status', 'todo')
        ]);
    }

    public function updateTodo(Request $request)
    {
        $this->update([
            'title' => $request->has('title') ? $request->title : $this->title ,
            'body' => $request->has('body') ? $request->body : $this->body ,
            'status' => $request->has('status') ? $request->status : $this->status ,
            'schedule_time' => $request->has('schedule_time') ? $request->schedule_time : $this->schedule_time ,
        ]);
    }
}
