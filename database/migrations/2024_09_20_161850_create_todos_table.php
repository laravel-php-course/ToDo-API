<?php

use App\Models\Todo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title', length: Todo::TITLE_MAX_LENGTH);
            $table->enum('status', ['todo', 'done', 'in-progress', 'delete'])->default(Todo::DEFAULT);
            $table->text('body');
            $table->dateTime('schedule_time')->nullable();
            $table->timestamps();
            //TODO add category column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
