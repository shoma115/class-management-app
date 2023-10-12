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
        Schema::create('class_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cacadeOnDelete();
            $table->string("class_name");
            $table->string('teacher_name')->nullable(true);
            $table->string('class_week_day');
            $table->integer('class_time');
            $table->string('class_place')->nullable(true);
            $table->integer('amount_credit');
            $table->string('evaluation')->nullable(true);
            $table->string('attendance')->nullable(true);
            $table->string('division_1')->nullable(true);
            $table->string('division_2')->nullable(true);
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
        Schema::dropIfExists('class_data');
    }
};
