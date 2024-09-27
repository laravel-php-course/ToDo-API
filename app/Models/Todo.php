<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'status', 'body', 'user_id', 'schedule_time'];

    const DEFAULT = 'todo';
    const TITLE_MAX_LENGTH = 255;
    const BODY_MAX_LENGTH = 1000;
    const STATUSES = ['todo', 'in-progress', 'done'];

}
