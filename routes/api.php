<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * GET    /todos                     => get All Todos
 * GET    /todos/todo_id             => get specific todo
 * POST   /todos                     => new record todo
 * PUT    /todos/todo_id             => update todo
 * DELETE /todos/todo_id             => delete todo
 */

// Route::post('/todos', [TodoController::class, 'store']);
// Route::get("/todos",[TodoController::class,"index"]);
// Route::get("/todos/{todo}",[TodoController::class,"show"]);
// Route::put("/todos/{todo}",[TodoController::class,"update"]);
// Route::delete("/todos/{todo}",[TodoController::class,"destroy"]);

Route::apiResource('/todos',TodoController::class)->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
