<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cacadeOnDelete();
            $table->string("class_name");
            $table->integer('difficulty_level');
            $table->integer('interesting');
            $table->string('teacher_name')->nullable(true);
            $table->string('class_week_day');
            $table->integer('class_time');
            $table->integer('amount_credit')->nullable(true);;
            $table->string('evaluation')->nullable(true);
            $table->string('attendance')->nullable(true);
            $table->text('content')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
